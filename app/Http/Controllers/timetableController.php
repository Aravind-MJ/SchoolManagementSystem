<?php

namespace App\Http\Controllers;

use App\TimeTableInit;
use App\User;
use App\Variables;
use Illuminate\Support\Facades\Redirect;
use App\Timetable;
use App\Http\Requests\TimetableInitRequest;
use App\Http\Requests\TimetableConfigRequest;
use App\Batch;
use App\Faculty;
use App\Subject;
use Illuminate\Support\Facades\Request;

class TimetableController extends Controller
{

    public function index()
    {
        $section = Request::input('section');
        if ($section == null) {
            $section = 'HS';
        }
        $period_head = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'];
        $data = new Variables;
        $tnp = $data->getof('TNP', $section);
        $tnd = $data->getof('TND', $section);
        $period_head = array_slice($period_head, 0, $tnp);
        $timetable = new Timetable;
        $timetable = $timetable->where('section', $section)->orderBy('updated_at', 'desc')->first();
        if ($timetable == null) {
            $period = array();
        } else {
            $table = json_decode($timetable->json, true);
            $period = array();
            foreach ($table as $slot) {
                $sp = explode('-', $slot['key']);
                $entities = json_decode($slot['entities']);
                foreach ($entities as $entity) {
                    $batch = new Batch;
                    $batch = $batch->find($entity->batch_id)->batch;
                    $faculty = new User;
                    $faculty = $faculty->find($entity->faculty_id);
                    if ($faculty == null) {
                        $faculty = 'Not found';
                    } else {
                        $faculty = $faculty->first_name . ' ' . $faculty->last_name;
                    }
                    $subject = new Subject;
                    $subject = $subject->find($entity->subject_id)->subject_name;
                    $period['batches'][$entity->batch_id]['name'] = $batch;
                    $period['batches'][$entity->batch_id]['table'][(int)$sp[0]][(int)$sp[1]] = [
                        'relate' => $faculty,
                        'subject_name' => $subject
                    ];
                    $period['faculties'][$faculty]['name'] = $faculty;
                    $period['faculties'][$faculty]['table'][(int)$sp[0]][(int)$sp[1]] = [
                        'relate' => $batch,
                        'subject_name' => $subject
                    ];
                }
            }
            for ($i = 0; $i < $tnd; $i++) {
                for ($j = 0; $j < $tnp; $j++) {
                    foreach ($period['faculties'] as $key => $faculty) {
                        if (!isset($faculty['table'][$i][$j])) {
                            $period['faculties'][$key]['table'][$i][$j] = [
                                'subject_name' => "Free Period"
                            ];
                        }
                    }
                }
            }

            function recur_ksort(&$array)
            {
                foreach ($array as &$value) {
                    if (is_array($value)) {
                        recur_ksort($value);
                    }
                }
                return ksort($array);
            }

            recur_ksort($period);
        }
        return view('timetable.timetable', ['table' => $period, 'section' => $section, 'period_head' => $period_head]);
    }

    public function store(TimetableInitRequest $request)
    {
        $options = new TimeTableInit;
        $options->batch_id = $request['batch'];
        $options->faculty_id = $request['faculty'];
        $options->subject_id = $request['subject'];
        $options->no_of_periods = $request['no_of_periods'];
        $options->section = $request['section'];
        if ($request['sticky'] == null) {
            $options->sticky = 'NO';
        } else {
            $options->sticky = 'YES';
        }
        $options->save();
        return redirect('Timetable/init?section=' . $request['section'])
            ->withFlashMessage('Option Added Successfully!')
            ->withType('success');
    }

    public function update($id, TimetableInitRequest $request)
    {
        $options = new TimeTableInit;
        $options = $options->find($id);
        $options->batch_id = $request['batch'];
        $options->faculty_id = $request['faculty'];
        $options->subject_id = $request['subject'];
        $options->no_of_periods = $request['no_of_periods'];
        $options->section = $request['section'];
        if ($request['sticky'] == null) {
            $options->sticky = 'NO';
        } else {
            $options->sticky = 'YES';
        }
        $options->save();
        return redirect('Timetable/init?section=' . $request['section'])
            ->withFlashMessage('Option Edited Successfully!')
            ->withType('success');
    }

    public function show($id)
    {
        if ($id == 'config') {
            $section = Request::input('section');
            if ($section == null) {
                $section = 'HS';
            }
            $data = new Variables;
            $current_no_of_days_week = $data->getof('TND', $section);
            $current_no_of_hours_day = $data->getof('TNP', $section);
            return view('timetable.tableconfig', compact('current_no_of_days_week', 'current_no_of_hours_day', 'section'));
        } else if ($id == 'init') {
            $section = Request::input('section');
            if ($section == null) {
                $section = 'HS';
            }
            $options = new TimeTableInit;

            $latest = $options
                ->join('subject', 'subject.id', '=', 'subject_id')
                ->join('users', 'users.id', '=', 'faculty_id')
                ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
                ->select('batch_timetable_config.id', 'batch_timetable_config.no_of_periods',
                    'batch_timetable_config.sticky', 'batch_details.batch', 'batch_details.in_charge',
                    'users.first_name', 'users.last_name', 'subject.subject_name', 'batch_timetable_config.batch_id',
                    'batch_timetable_config.faculty_id', 'batch_timetable_config.subject_id')
                ->where('batch_timetable_config.section', $section)
                ->orderBy('batch_timetable_config.updated_at', 'DESC')
                ->take('5')
                ->get();

            foreach ($latest as $option) {
                $faculty = new User;
                $faculty = $faculty->find($option->in_charge);
                if ($faculty == null) {
                    $option->in_charge = 'Not found';
                } else {
                    $option->in_charge = $faculty->first_name . ' ' . $faculty->last_name;
                }
            }

            $options = $options
                ->join('subject', 'subject.id', '=', 'subject_id')
                ->join('users', 'users.id', '=', 'faculty_id')
                ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
                ->select('batch_timetable_config.id', 'batch_timetable_config.no_of_periods',
                    'batch_timetable_config.sticky', 'batch_details.batch', 'batch_details.in_charge',
                    'users.first_name', 'users.last_name', 'subject.subject_name', 'batch_timetable_config.batch_id',
                    'batch_timetable_config.faculty_id', 'batch_timetable_config.subject_id')
                ->where('batch_timetable_config.section', $section)
                ->get();

            foreach ($options as $option) {
                $faculty = new User;
                $faculty = $faculty->find($option->in_charge);
                if ($faculty == null) {
                    $option->in_charge = 'Not found';
                } else {
                    $option->in_charge = $faculty->first_name . ' ' . $faculty->last_name;
                }
            }

            $batch = new Batch;
            $batch = $batch
                ->get();
            $data = array();
            $data[null] = 'Select a batch';
            foreach ($batch as $each_batch) {
                $data[$each_batch->id] = $each_batch->batch;
            }
            $batch = $data;

            $faculty = new Faculty;
            $faculty = $faculty
                ->join('users', 'users.id', '=', 'faculty_details.user_id')
                ->get();
            $data = array();
            $data[null] = 'Select a Faculty';
            foreach ($faculty as $each_faculty) {
                $data[$each_faculty->id] = $each_faculty->first_name . ' ' . $each_faculty->last_name;
            }
            $faculty = $data;

            $subject = new Subject;
            $subject = $subject
                ->get();
            $data = array();
            $data[null] = 'Select a Subject';
            foreach ($subject as $each_subject) {
                $data[$each_subject->id] = $each_subject->subject_name;
            }
            $subject = $data;

            return view('timetable.tableinit', compact('batch', 'faculty', 'subject', 'options', 'latest', 'section'));
        }
    }

    public function destroy($id)
    {
        $options = new TimeTableInit;
        $options->find($id)->delete();
        return redirect('Timetable/init?section=' . Request::input('section'))
            ->withFlashMessage('Option deleted!')
            ->withType('success');
    }

    public function timetable_config(TimeTableConfigRequest $requestData)
    {
        $timetable_config = new Variables;
        $timetable_config->setof('TND', $requestData->input('no_of_days_week'), $requestData->input('section'));
        $timetable_config->setof('TNP', $requestData->input('no_of_hours_day'), $requestData->input('section'));
        return Redirect::back()
            ->withFlashMessage('Timetable Configuration Changed successfully!')
            ->withType('success');

    }
}

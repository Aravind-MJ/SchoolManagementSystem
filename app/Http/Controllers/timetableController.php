<?php

namespace App\Http\Controllers;

use App\TimeTableInit;
use App\Variables;
use Illuminate\Support\Facades\Redirect;
use App\Timetable;
use App\Http\Requests\TimetableInitRequest;
use App\Http\Requests\TimetableConfigRequest;
use App\Batch;
use App\Faculty;
use App\Subject;
use App\Error;
use App\TimeTableConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Mockery\CountValidator\Exception;

class TimetableController extends Controller
{

    private $TND, $TNP, $TOTAL_PERIODS, $BATCH, $FACULTY, $OPTIONS;
    public $ERRORS;

    public function index()
    {
        return view('timetable.timetable');
    }

/////////////////////////////////////////////////////////////////////////////////
    public function create()
    {
        try {
            $this->ERRORS = array();
            $this->initConfig();
            $this->validateData();
            $this->initOptions();
        } catch (Exception $e) {
            return view('timetable.timetable_error', ['list_errors' => $this->ERRORS]);
        }
    }

    private function initConfig()
    {
        $data = new Variables;
        $this->TND = $data->get('TND');
        $this->TNP = $data->get('TNP');
        $this->TOTAL_PERIODS = $this->TND * $this->TNP;
    }

    private function validateData()
    {
        $options = new TimeTableInit;
        $count = $options->get();
        if (count($count) <= 0) {
            array_push($this->ERRORS,
                new Error('No data available to generate Timetable', 'danger')
            );
            $this->displayError();
        }
        $check_faculty = $options->select(DB::raw('SUM(no_of_periods) as nop,faculty_id'))
            ->groupBy('faculty_id')->get();
        foreach ($check_faculty as $check) {
            if ($check->nop > $this->TOTAL_PERIODS) {
                $difference = $check->nop - $this->TOTAL_PERIODS;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Faculty '
                        . $check->faculty_id . ' exceeds TOTAL NO OF PERIODS A WEEK by '
                        . $difference . ' periods',
                        'danger'
                    )
                );
            }
        }

        $check_batch = $options->select(DB::raw('SUM(no_of_periods) as nop,batch_id'))
            ->groupBy('batch_id')->get();
        foreach ($check_batch as $check) {
            if ($check->nop > $this->TOTAL_PERIODS) {
                $difference = $check->nop - $this->TOTAL_PERIODS;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Batch '
                        . $check->batch_id . ' exceeds TOTAL NO OF PERIODS A WEEK by '
                        . $difference . ' periods',
                        'danger'
                    )
                );
            }
            if ($check->nop < $this->TOTAL_PERIODS) {
                $difference = $this->TOTAL_PERIODS - $check->nop;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Batch '
                        . $check->batch_id . ' is less than the TOTAL NO OF PERIODS A WEEK by '
                        . $difference . ' periods',
                        'warning'
                    )
                );
            }
        }
//      Check whether the no of periods a subject have exceeds the Total Number of Periods.
//      (Seems unnecessary at this point hence commented)
//        $check_subject = $options->select(DB::raw('SUM(no_of_periods) as nop,batch_id,subject_id'))
//            ->groupBy('batch_id', 'subject_id')->get();
//        foreach ($check_subject as $check) {
//            if ($check->nop > $this->TNP * $this->TND) {
//                array_push($this->ERRORS,
//                    new Error(
//                        'Total no of periods of Subject '
//                        . $check->subject_id . ' of Batch '
//                        . $check->batch_id . ' exceeds TOTAL NO OF PERIODS A WEEK',
//                        'danger'
//                    )
//                );
//            }
//        }

//      Check whether sticky subjects have even number of periods.
        $check_sticky = $options->where('sticky', 'YES')->get();
        foreach ($check_sticky as $check) {
            if ($check->no_of_periods % 2 != 0) {
                array_push($this->ERRORS,
                    new Error(
                        'The sticky Subject '
                        . $check->subject_id . ' of batch '
                        . $check->batch_id . ' doesn\'t have even no of periods',
                        'warning'
                    )
                );
            }
        }

//      Checks whether a faculty in charge of a Class/Batch have periods assigned to that Class/Batch
        $check_incharge = $options->select(DB::raw('DISTINCT(batch_timetable_config.batch_id) as batch_id,batch_details.in_charge   '))
            ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')->get();
        foreach ($check_incharge as $check) {
            $in_charge = $options->where(['batch_id' => $check->batch_id, 'faculty_id' => $check->in_charge])->first();
            if (count($in_charge) <= 0) {
                array_push($this->ERRORS,
                    new Error(
                        'The Faculty  '
                        . $check->in_charge . ' in charge of batch '
                        . $check->batch_id . ' doesn\'t have any periods on this batch',
                        'danger'
                    )
                );
            }
        }

//      Call function to display errors if any.
        $this->displayError();
    }

//Check if any errors exist and Throw exception to display those errors.
    private function displayError()
    {
        if (count($this->ERRORS) > 0) {
            throw new Exception;
        }
    }

    private function initOptions()
    {
        $options = new TimeTableInit;
        $this->OPTIONS = $options->get();
        $this->BATCH = array();
        $this->FACULTY = array();
    }


///////////////////////////////////////////////////////////////////////////////////
    public function store(TimetableInitRequest $request)
    {
        $options = new TimeTableInit;
        $options->batch_id = $request['batch'];
        $options->faculty_id = $request['faculty'];
        $options->subject_id = $request['subject'];
        $options->no_of_periods = $request['no_of_periods'];
        if ($request['sticky'] == null) {
            $options->sticky = 'NO';
        } else {
            $options->sticky = 'YES';
        }
        $options->save();
        return redirect('Timetable/init')
            ->withFlashMessage('Option Added!')
            ->withType('success');
    }

    public function show($id)
    {
        if ($id == 'config') {
            $data = new TimeTableConfig;
            $data = $data->find(1);
            $current_no_of_days_week = $data->no_of_days_week;
            $current_no_of_hours_day = $data->no_of_hours_day;
            return view('timetable.tableconfig', compact('current_no_of_days_week', 'current_no_of_hours_day'));
        } else if ($id == 'init') {
            $options = new TimeTableInit;
            $options = $options
                ->join('subject', 'subject.id', '=', 'subject_id')
                ->join('users', 'users.id', '=', 'faculty_id')
                ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
                ->select('batch_timetable_config.id', 'batch_timetable_config.no_of_periods',
                    'batch_timetable_config.sticky', 'batch_details.batch', 'users.first_name',
                    'users.last_name', 'subject.subject_name')
                ->orderBy('batch_details.batch')
                ->get();

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

            return view('timetable.tableinit', compact('batch', 'faculty', 'subject', 'options'));
        }
    }

    public function destroy($id)
    {
        $options = new TimeTableInit;
        $options->find($id)->delete();
        return redirect('Timetable/init')
            ->withFlashMessage('Option deleted!')
            ->withType('success');
    }

    public function timetable_config(TimeTableConfigRequest $requestData)
    {
        $timetable_config = TimeTableConfig::find(1);
        $timetable_config->no_of_days_week = $requestData->input('no_of_days_week');
        $timetable_config->no_of_hours_day = $requestData->input('no_of_hours_day');
        $timetable_config->save();
        return Redirect::back()
            ->withFlashMessage('Timetable Configuration Changed successfully!')
            ->withType('success');

    }
}

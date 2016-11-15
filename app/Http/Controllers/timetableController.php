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
use App\Error;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Mockery\CountValidator\Exception;

class TimetableController extends Controller
{

    private $TND, $TNP, $TOTAL_PERIODS, $BT, $FT, $CB, $CF, $SB, $SF;
    public $ERRORS;

    public function index()
    {
        return view('timetable.timetable');
    }

///////////////////////~~~~Helper Functions Section Start~~~~///////////////////////////////////////

//Check if any errors exist and Throw exception to display those errors.
    private function displayError()
    {
        if (count($this->ERRORS) > 0) {
            throw new Exception;
        }
    }

//Function to highlight particulars in error message
    private function bold($object, $prop = 'id')
    {
        if (!is_object($object)) {
            return '<strong style="font-size: 18px;">' . $object . '</strong>';
        }
        if ($object == null) {
            return '<small>(Failed to find ' . $prop . ')</small>';
        } elseif (is_array($prop)) {
            $string = '';
            foreach ($prop as $pro) {
                $string .= ' ' . $object->$pro;
            }
            return '<strong style="font-size: 18px;">' . $string . '</strong>';
        } else {
            return '<strong style="font-size: 18px;">' . $object->$prop . '</strong>';
        }
    }

//Function to randomize Batch
    private function randBatch()
    {
        if (count($this->BT) <= 0) {
            return false;
        } elseif (count($this->BT) == 1) {
            $this->SB = array_pop($this->BT);
            return true;
        } else {
            $this->SB = array_rand($this->BT);
            return true;
        }
    }

//Function to randomize Faculty
    private function randFaculty()
    {
        if (count($this->FT) <= 0) {
            return false;
        } elseif (count($this->FT) == 1) {
            $this->SF = array_pop($this->FT);
        } else {
            $this->SF = array_rand($this->FT);
            return true;
        }
    }

    //Take dot notation array and make it a three dimensional array
    private function to3D($array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            array_set($return, $key, $value);
        }
        return $return;
    }

    private function periodAlloted($key)
    {
        if (!isset($this->CB[$this->SB])) {
            $this->CB[$this->SB] = array();
        }
        if (!isset($this->CF[$this->SF])) {
            $this->CF[$this->SF] = array();
        }

        $this->CB[$this->SB][$key] = array_pull($this->BT[$this->SB], $key);
        $this->FT[$this->SF][$key] = array_pull($this->FT[$this->SF], $key);

        if (count($this->BT[$this->SB]) <= 0) {
            unset($this->BT[$this->SB]);
        }
        if (count($this->FT[$this->SF]) <= 0) {
            unset($this->FT[$this->SF]);
        }
        $this->SB = $this->SF = null;
    }

    private function isSticky($id)
    {
        $sticky = new TimeTableInit;
        $sticky = $sticky->where('subject_id', $id)->first();
        if ($sticky == null) {
            array_push($this->ERRORS,
                new Error('Subject with id:' . $id . ' not found', 'danger')
            );
            $this->displayError();
        } elseif ($sticky->sticky == 'YES') {
            return true;
        } else {
            return false;
        }
    }



///////////////////////~~~~Helper Functions Section End~~~~/////////////////////////////////////////////

///////////////////////~~~~Timetable Generation Section Start~~~~///////////////////////////////////////
    public function create()
    {
        try {
            $this->ERRORS = array();
            $this->initConfig();
            $this->validateData();
            $this->initOptions();
            $this->generate();
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

//      Check whether any data available for proceeding Timetable generation
        $count = $options->get();
        if (count($count) <= 0) {
            array_push($this->ERRORS,
                new Error('No data available to generate Timetable', 'danger')
            );
            $this->displayError();
        }

//      Check whether total no of periods allotted to a Faculty exceeds the Total no of periods a week
        $check_faculty = $options->select(DB::raw('SUM(no_of_periods) as nop,faculty_id'))
            ->groupBy('faculty_id')->get();
        foreach ($check_faculty as $check) {
            $faculty = new User;
            $faculty = $faculty->find($check->faculty_id);
            $name = $faculty->first_name . ' ' . $faculty->last_name;
            if ($check->nop > $this->TOTAL_PERIODS) {
                $difference = $check->nop - $this->TOTAL_PERIODS;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Faculty '
                        . $this->bold($faculty, ['first_name', 'last_name']) . ' exceeds TOTAL NO OF PERIODS A WEEK by '
                        . $this->bold($difference) . ' periods',
                        'danger'
                    )
                );
            }
        }

//      Check whether total no of periods allotted to a Batch exceeds the Total no of periods a week
        $check_batch = $options->select(DB::raw('SUM(no_of_periods) as nop,batch_id'))
            ->groupBy('batch_id')->get();
        foreach ($check_batch as $check) {
            if ($check->nop > $this->TOTAL_PERIODS) {
                $batch = new Batch;
                $batch = $batch->find($check->batch_id);
                $difference = $check->nop - $this->TOTAL_PERIODS;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Batch '
                        . $this->bold($batch, 'batch') . ' exceeds TOTAL NO OF PERIODS A WEEK by '
                        . $this->bold($difference) . ' periods',
                        'danger'
                    )
                );
            }
            if ($check->nop < $this->TOTAL_PERIODS) {
                $batch = new Batch;
                $batch = $batch->find($check->batch_id);
                $difference = $this->TOTAL_PERIODS - $check->nop;
                array_push($this->ERRORS,
                    new Error(
                        'Total no of periods of Batch '
                        . $this->bold($batch, 'batch') . ' is less than the TOTAL NO OF PERIODS A WEEK by '
                        . $this->bold($difference) . ' periods',
                        'info'
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
                $subject = new Subject;
                $subject = $subject->find($check->subject_id);
                $batch = new Batch;
                $batch = $batch->find($check->batch_id);
                array_push($this->ERRORS,
                    new Error(
                        'The sticky Subject '
                        . $this->bold($subject, 'subject_name') . ' of batch '
                        . $this->bold($batch, 'batch') . ' doesn\'t have even no of periods',
                        'info'
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
                $batch = new Batch;
                $batch = $batch->find($check->batch_id);
                $faculty = new User;
                $faculty = $faculty->find($check->in_charge);
                array_push($this->ERRORS,
                    new Error(
                        'The Faculty  '
                        . $this->bold($faculty, ['first_name', 'last_name']) . ' in charge of batch '
                        . $this->bold($batch, 'batch') . ' doesn\'t have any periods on this batch',
                        'info'
                    )
                );
            }
        }

        //Check whether multiple faculties are in charge of any batch.
        $cmic = new Batch;
        $cmic = $cmic->select(DB::raw('COUNT(*) as count,batch'))->groupBy('in_charge')->get();
        foreach ($cmic as $check) {
            if ($check->count > 1) {
                array_push($this->ERRORS,
                    new Error(
                        'Multiple faculties in charge of '
                        . $this->bold($check, 'batch'),
                        'danger'
                    )
                );
            }
        }

//      Call function to display errors if any.
        $this->displayError();
    }

    private function initOptions()
    {
        $options = new TimeTableInit;
        $batches = $options->select(DB::raw('DISTINCT(batch_id)'))->get();
        $faculties = $options->select(DB::raw('DISTINCT(faculty_id)'))->get();
        $this->BT = array();
        $this->FT = array();
        foreach ($batches as $batch) {
            for ($i = 0; $i < $this->TND; $i++) {
                for ($j = 0; $j < $this->TNP; $j++) {
                    $this->BT[$batch->batch_id][$i . '.' . $j] = 'EMPTY';
                }
            }
        }
        foreach ($faculties as $faculty) {
            for ($i = 0; $i < $this->TND; $i++) {
                for ($j = 0; $j < $this->TNP; $j++) {
                    $this->FT[$faculty->faculty_id][$i . '.' . $j] = 'EMPTY';
                }
            }
        }
    }

    private function generate()
    {

    }


//////////////////////////~~~~Timetable Generation Section Ends~~~~//////////////////////////////////////
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
        if ($request['sticky'] == null) {
            $options->sticky = 'NO';
        } else {
            $options->sticky = 'YES';
        }
        $options->save();
        return redirect('Timetable/init')
            ->withFlashMessage('Option Edited Successfully!')
            ->withType('success');
    }

    public function show($id)
    {
        if ($id == 'config') {
            $data = new Variables;
            $current_no_of_days_week = $data->get('TND');
            $current_no_of_hours_day = $data->get('TNP');
            return view('timetable.tableconfig', compact('current_no_of_days_week', 'current_no_of_hours_day'));
        } else if ($id == 'init') {
            $options = new TimeTableInit;
            $latest = $options
                ->join('subject', 'subject.id', '=', 'subject_id')
                ->join('users', 'users.id', '=', 'faculty_id')
                ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
                ->select('batch_timetable_config.id', 'batch_timetable_config.no_of_periods',
                    'batch_timetable_config.sticky', 'batch_details.batch', 'users.first_name',
                    'users.last_name', 'subject.subject_name', 'batch_timetable_config.batch_id',
                    'batch_timetable_config.faculty_id', 'batch_timetable_config.subject_id')
                ->orderBy('batch_timetable_config.updated_at', 'DESC')
                ->take('5')
                ->get();
            $options = $options
                ->join('subject', 'subject.id', '=', 'subject_id')
                ->join('users', 'users.id', '=', 'faculty_id')
                ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
                ->select('batch_timetable_config.id', 'batch_timetable_config.no_of_periods',
                    'batch_timetable_config.sticky', 'batch_details.batch', 'users.first_name',
                    'users.last_name', 'subject.subject_name', 'batch_timetable_config.batch_id',
                    'batch_timetable_config.faculty_id', 'batch_timetable_config.subject_id')
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

            return view('timetable.tableinit', compact('batch', 'faculty', 'subject', 'options', 'latest'));
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
        $timetable_config = new Variables;
        $timetable_config->set('TND', $requestData->input('no_of_days_week'));
        $timetable_config->set('TNP', $requestData->input('no_of_hours_day'));
        return Redirect::back()
            ->withFlashMessage('Timetable Configuration Changed successfully!')
            ->withType('success');

    }
}

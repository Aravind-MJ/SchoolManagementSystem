<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Timetable;
use App\TimeTableInit;
use App\Variables;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use App\User;
use App\Batch;
use App\Faculty;
use App\Subject;
use App\Error;
use App\Slots;

class TimetableGeneratorController extends Controller
{
    private $TND, $TNP, $TNB, $TOTAL_PERIODS, $SECTION, $SUBJECTS, $IC, $STICKY;
    private $COLLECTED;
    public $ERRORS;

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


///////////////////////~~~~Helper Functions Section End~~~~/////////////////////////////////////////////

///////////////////////~~~~Timetable Generation Section Start~~~~///////////////////////////////////////
    public function create()
    {
        $this->SECTION = Request::input('section');
        if ($this->SECTION == null) {
            $this->SECTION = 'HS';
        }
        try {
            $this->ERRORS = array();
            $this->initConfig();
            $this->validateData();
            $this->initOptions();
            $this->generate();
            if(count($this->COLLECTED)<=0) {
                $table = new Timetable();
                $slots = new Slots();
                $table->json = json_encode($slots->select('key','entities')->get()->toArray());
                $table->section = $this->SECTION;
                $table->save();
                return redirect('/Timetable?section=' . $this->SECTION);
            }else{
                dd('Failed. Please try again');
            }
        } catch (Exception $e) {
            return view('timetable.timetable_error', ['list_errors' => $this->ERRORS, 'section' => $this->SECTION]);
        }
    }

    private function initConfig()
    {
        $data = new Variables;
        $this->TND = $data->getof('TND', $this->SECTION);
        $this->TNP = $data->getof('TNP', $this->SECTION);
        $this->TOTAL_PERIODS = $this->TND * $this->TNP;
    }

    private function validateData()
    {
        $options = new TimeTableInit;

//      Check whether any data available for proceeding Timetable generation
        $count = $options->where('section', $this->SECTION)->get();
        if (count($count) <= 0) {
            array_push($this->ERRORS,
                new Error('No data available to generate Timetable', 'danger')
            );
            $this->displayError();
        }
        unset($count);

//      Check whether total no of periods allotted to a Faculty exceeds the Total no of periods a week
        $check_faculty = $options->select(DB::raw('SUM(no_of_periods) as nop,faculty_id'))
            ->where('section', $this->SECTION)
            ->groupBy('faculty_id')->get();
        foreach ($check_faculty as $check) {
            $faculty = new User;
            $faculty = $faculty->find($check->faculty_id);
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
        unset($check_faculty);

//      Check whether total no of periods allotted to a Batch exceeds the Total no of periods a week
        $check_batch = $options->select(DB::raw('SUM(no_of_periods) as nop,batch_id'))
            ->where('section', $this->SECTION)
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
        unset($check_batch);

//      Check whether sticky subjects have even number of periods.
        $check_sticky = $options->where('sticky', 'YES')->where('section', $this->SECTION)->get();
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
        unset($check_sticky);

//      Checks whether a faculty in charge of a Class/Batch have periods assigned to that Class/Batch
        $check_incharge = $options->select(DB::raw('DISTINCT(batch_timetable_config.batch_id) as batch_id,batch_details.in_charge'))
            ->join('batch_details', 'batch_details.id', '=', 'batch_timetable_config.batch_id')
            ->where('section', $this->SECTION)
            ->get();
        foreach ($check_incharge as $check) {
            $in_charge = $options
                ->where(['batch_id' => $check->batch_id, 'faculty_id' => $check->in_charge, 'section' => $this->SECTION])
                ->first();
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
        unset($check_incharge);

        //Check whether multiple faculties are in charge of any batch.
        $cmic = new Batch;
        $cmic = $cmic->select(DB::raw('COUNT(*) as count,batch,in_charge'))->groupBy('in_charge')->get();
        foreach ($cmic as $check) {
            if ($check->count > 1) {
                $faculty = new User;
                $faculty = $faculty->find($check->in_charge);
                array_push($this->ERRORS,
                    new Error(
                        'Faculty '
                        . $this->bold($faculty, ['first_name', 'last_name'])
                        . ' is in charge of multiple classes',
                        'danger'
                    )
                );
            }
        }
        unset($cmic);

        unset($in_charge);
        unset($options);
        unset($batch);
        unset($faculty);
        unset($subject);
        unset($check);

//      Call function to display errors if any.
        $this->displayError();
    }

    private function initOptions()
    {
        $option = new TimeTableInit;
        $this->TNB = count($option->groupBy('batch_id')->where('section',$this->SECTION)->get());
        $this->IC = $option->getInCharge($this->SECTION);
        $this->STICKY = $option->getSticky($this->SECTION);
        $this->SUBJECTS = $option->getOthers($this->SECTION);

        $slots = new Slots;
        for ($i = 0; $i < $this->TND; $i++) {
            for ($j = 0; $j < $this->TNP; $j++) {
                $slot = $slots->where('key', $i . '-' . $j)->first();
                if ($slot == null) {
                    $slot = new Slots;
                    $slot->key = $i . '-' . $j;
                }
                $slot->left = $this->TNB;
                $slot->entities = '';
                $slot->save();
            }
        }
    }

    private function generate()
    {
        $this->COLLECTED = array();
        $this->allotInCharge();
        $this->allotSticky();
        $this->allotSubjects();
        $this->displayError();
    }

    //Function to allot all faculty in charge subjects first
    private function allotInCharge()
    {
        $slots = new Slots();
        foreach ($this->IC as $entity) {
            while($entity['no_of_periods'] > 0) {
                $slot = $slots->getStartFreeSlot($entity);
                if($slot==null){
                    $this->COLLECTED []= $entity;
                    break;
                }
                $entities = json_decode($slot->entities);
                if(!is_array($entities)){
                    $entities = array();
                }
                array_push($entities,$entity);
                $slot->entities = json_encode($entities);
                $slot->left--;
                $slot->save();
                $entity['no_of_periods']--;
            }
            while($entity['no_of_periods'] > 0) {
                $this->COLLECTED []= $entity;
            }
        }
        unset($this->IC);
        unset($slots);
        unset($slot);
        unset($entity);
        unset($entities);
    }

    //Function used to allot all sticky subject
    private function allotSticky()
    {
        $slots = new Slots();
        foreach ($this->STICKY as $entity){
            while($entity['no_of_periods'] > 0) {
                $slot = $slots->getStickySlot($entity,$this->TNP);
                if($slot[0]==null OR $slot[1]==null){
                    $this->COLLECTED []= $entity;
                    break;
                }

                //First period
                $entities = json_decode($slot[0]->entities);
                if(!is_array($entities)){
                    $entities = array();
                }
                array_push($entities,$entity);
                $slot[0]->entities = json_encode($entities);
                $slot[0]->left--;
                $slot[0]->save();
                $entity['no_of_periods']--;

                //Second Period
                $entities = json_decode($slot[1]->entities);
                if(!is_array($entities)){
                    $entities = array();
                }
                array_push($entities,$entity);
                $slot[1]->entities = json_encode($entities);
                $slot[1]->left--;
                $slot[1]->save();
                $entity['no_of_periods']--;
            }
        }
        unset($this->STICKY);
        unset($slots);
        unset($slot);
        unset($entity);
        unset($entities);
    }

    private function allotSubjects()
    {
        $slots = new Slots();
        foreach ($this->SUBJECTS as $entity) {
            while($entity['no_of_periods'] > 0) {
                $slot = $slots->getFreeSlot($entity);
                if($slot==null){
                    $this->COLLECTED []= $entity;
                    break;
                }
                $entities = json_decode($slot->entities);
                if(!is_array($entities)){
                    $entities = array();
                }
                array_push($entities,$entity);
                $slot->entities = json_encode($entities);
                $slot->left--;
                $slot->save();
                $entity['no_of_periods']--;
            }
            while($entity['no_of_periods'] > 0) {
                $this->COLLECTED []= $entity;
            }
        }
        unset($this->SUBJECTS);
        unset($slots);
        unset($slot);
        unset($entity);
        unset($entities);
    }


//////////////////////////~~~~Timetable Generation Section Ends~~~~//////////////////////////////////////
}

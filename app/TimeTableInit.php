<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTableInit extends Model
{
    protected $table = "batch_timetable_config";
    private $fetched = array();

    public function getAll($section)
    {
        return $this
            ->select('batch_id', 'subject_id', 'faculty_id', 'no_of_periods', 'sticky')
            ->where('section', $section)->get();
    }

    public function getInCharge($section)
    {
        $result = $this
            ->join('class_details', function ($join) {
                $join->on('batch_timetable_config.batch_id', '=', 'class_details.id');
                $join->on('batch_timetable_config.faculty_id', '=', 'class_details.in_charge');
            })
            ->select('batch_timetable_config.id', 'batch_id', 'subject_id', 'faculty_id', 'no_of_periods', 'sticky')
            ->where('section', $section)
            ->where('sticky', '!=', 'YES')
            ->get()->toArray();
        foreach ($result as $entity) {
            array_push($this->fetched,$entity['id']);
            $entity['locked'] = true;
        }
        return $result;
    }

    public function getSticky($section)
    {
        $result = $this
            ->select('batch_timetable_config.id', 'batch_id', 'subject_id', 'faculty_id', 'no_of_periods', 'sticky')
            ->where('section', $section)
            ->where('sticky', 'YES')
            ->get()->toArray();
        foreach ($result as $entity) {
            array_push($this->fetched,$entity['id']);
            $entity['locked'] = true;
        }
        return $result;
    }

    public function getOthers($section)
    {
        $result = $this
            ->select('batch_timetable_config.id', 'batch_id', 'subject_id', 'faculty_id', 'no_of_periods', 'sticky')
            ->where('section', $section)
            ->whereNotIn('id',$this->fetched)
            ->get()->toArray();
        return $result;
    }

    public function filter(){
        $temp = new \stdClass();
        $temp->batch_id = $this->batch_id;
        $temp->faculty_id = $this->faculty_id;
        $temp->subject_id = $this->subject_id;
        $temp->sticky = $this->sticky;
        $temp->no_of_periods = $this->no_of_periods;
        if(isset($this->locked)){
            $temp->locked = $this->locked;
        }
        return $temp;
    }
}

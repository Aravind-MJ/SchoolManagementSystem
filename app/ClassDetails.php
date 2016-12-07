<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassDetails extends Model
{
    protected $table = 'class_details';
    
    public function fetch() {
        $data = new \stdClass;
        $data->class = array();
        $data->division = array();
        $class = $this
            ->select(DB::raw('DISTINCT(class)'))
            ->orderBy('class')
            ->get();
        $data->class[null] = 'Select Class';
        foreach($class as $each_class){
            $data->class[$each_class->class]=$each_class->class;
        }
        
        $division = $this
            ->select(DB::raw('DISTINCT(division)'))
            ->orderBy('division')
            ->get();
        $data->division[null] = 'Select Division';
        foreach($division as $each_division){
            $data->division[$each_division->division]=$each_division->division;
        }
        
        return $data;
    }

    public function singleDropdown(){
        $data = array();
        $batch = $this->orderBy('class')->get();
        foreach ($batch as $each_batch) {
            $data[$each_batch->id] = strtoupper($each_batch->class) . ' ' . strtoupper($each_batch->division);
        }
        return $data;
    }
}

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
        foreach($class as $each_class){
            $data->class[$each_class->class]=$each_class->class;
        }
        
        $division = $this
            ->select(DB::raw('DISTINCT(division)'))
            ->orderBy('division')
            ->get();
        foreach($division as $each_division){
            $data->division[$each_division->division]=$each_division->division;
        }
        
        return $data;
    }
    
//    public function fetchClass() {
//        
//          $fetchclasses = $this       
//                  ->select('id','class')
//                  ->get();
//        $class=array();
//        foreach($fetchclasses as $fetchclass){
//            $class[$fetchclass->id]=$fetchclass->class;
//        }
//        return $class;
//    }
}

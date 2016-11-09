<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassDetails extends Model
{
    protected $table = 'class_details';
    
    public function fetch() {
        $year = new Variables;
        $year = $year->get('AY');
      $batch = $this
            ->select('id', 'class','division')
            ->where('year',$year)
            ->orderBy('class_details.created_at', 'ASC')
            ->get();
//        $batch = Batch::lists('batch', 'id')->prepend('Select Batch', '');
        $data = array();
        foreach ($batch as $batches) {
           $data[$batches->id] = $batches->class.' '.$batches->division;
           
        }
        return $data;
    }
}

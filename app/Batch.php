<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch_details';
    
    public function fetch() {
        $year = new Variables;
        $year = $year->get('AY');
    $batch = $this
            ->select('id', 'batch')
            ->where('year',$year)
            ->orderBy('batch_details.created_at', 'ASC')
            ->get();
//        $batch = Batch::lists('batch', 'id')->prepend('Select Batch', '');
        $data = array();
        foreach ($batch as $batches) {
           $data[$batches->id] = $batches->batch;
        }
        return $data;
    }
}

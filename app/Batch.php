<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch_details';
    
    public function fetch() {
    $batch = $this
            ->select('id', 'batch')
            ->orderBy('batch_details.created_at', 'ASC')
            ->get();
//        $batch = Batch::lists('batch', 'id')->prepend('Select Batch', '');
        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->year;
        }
        return $data;
    }
}

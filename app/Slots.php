<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slots extends Model
{
    protected $table = "process_slot";
    private $PREV = array();

    public function getStartFreeSlot($entity){
        return $this ->orderBy(DB::raw('RAND()'))
            ->where('key','LIKE','0-%')
            ->where('left','>',0)
            ->where('entities','NOT LIKE','%"batch_id":'.$entity['batch_id'].'%')
            ->where('entities','NOT LIKE','%"faculty_id":'.$entity['faculty_id'].'%')
            ->first();
    }

    public function getFreeSlot($entity){
        return $this ->orderBy(DB::raw('RAND()'))
            ->where('left','>',0)
            ->where('entities','NOT LIKE','%"batch_id":'.$entity['batch_id'].'%')
            ->where('entities','NOT LIKE','%"faculty_id":'.$entity['faculty_id'].'%')
            ->first();
    }
    public  function getStickySlot($entity, $TNP){
        do {
            $result1 = $this->orderBy(DB::raw('RAND()'))
                ->where('key', 'NOT LIKE', '%-0')
                ->where('key', 'NOT LIKE', '%-' . $TNP - 1)
                ->where('left', '>', 0)
                ->where('entities', 'NOT LIKE', '%"batch_id":' . $entity['batch_id'] . '%')
                ->where('entities', 'NOT LIKE', '%"faculty_id":' . $entity['faculty_id'] . '%');

            if(isset($this->PREV[$entity['batch_id']])){
                $result1->where('key','NOT LIKE',$this->PREV[$entity['batch_id']].'-%');
            }
            $result1 = $result1
                ->first();
            $slot = explode('-', $result1->key);
            $result2 = $this->orderBy(DB::raw('RAND()'))
                ->where('key', 'LIKE', $slot[0] . '-' . ($slot[1] + 1))
                ->where('left', '>', 0)
                ->where('entities', 'NOT LIKE', '%"batch_id":' . $entity['batch_id'] . '%')
                ->where('entities', 'NOT LIKE', '%"faculty_id":' . $entity['faculty_id'] . '%')
                ->first();
        }while($result2 == null);
        $this->PREV[$entity['batch_id']] = $slot[0];
        return [$result1,$result2];
    }
}

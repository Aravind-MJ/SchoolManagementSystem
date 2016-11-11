<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
     protected $table="variables";

    public function get($var){
        return $this->where('name',$var)->first()->value;
    }

    public function set($var,$value){
        $data = $this->where('name',$var)->first();
        $data->value = $value;
        $data->save();
    }
}

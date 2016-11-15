<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
protected $table="assignment";
public function batch() {
        return $this->hasMany('App\Batch');
   }

}

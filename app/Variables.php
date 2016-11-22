<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    protected $table = "variables";

    public function get($var)
    {
        return $this->where('name', $var)->first()->value;
    }

    public function getof($var, $where)
    {
        $sql = $this
            ->where([
                'name' => $var,
                'section' => $where
            ])
            ->first();
        if($sql==null){
            return null;
        }
        return $sql->value;
    }

    public function set($var, $value)
    {
        $data = $this->where('name', $var)->first();
        $data->value = $value;
        $data->save();
    }

    public function setof($var, $value, $where)
    {
        $data = $this
            ->where([
                'name'=> $var,
                'section' => $where
            ])->first();
        if($data==null){
            $data = new $this;
            $data->name = $var;
            $data->section = $where;
        }
        $data->value = $value;
        $data->save();
    }
}

<?php

namespace App;

class Error
{
    public $msg,$type;

    public function __construct($msg,$type){
        $this->msg = $msg;
        $this->type = $type;
    }
}

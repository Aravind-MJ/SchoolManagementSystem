<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends Request {

  public function authorize()
  {
     return true;
  }

  public function rules()
  {
    return [
    'evtname' => 'required',
    'descrp' => 'required',
    'img' => 'required|mimes:png,jpg,jpeg',
  ];
  }

}
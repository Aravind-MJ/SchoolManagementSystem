<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventUpdateRequest extends Request {

  public function authorize()
  {
     return true;
  }

  public function rules()
  {
    return [
    'img' => 'mimes:png,jpg,jpeg',
  ];
  }

}
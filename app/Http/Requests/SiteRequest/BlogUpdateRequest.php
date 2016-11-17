<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BlogUpdateRequest extends Request {

  public function authorize()
  {
     return true;
  }

  public function rules()
  {
    return [
    'featured_image' => 'mimes:png,jpg,jpeg',
  ];
  }

}
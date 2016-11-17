<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BlogRequest extends Request {

  public function authorize()
  {
     return true;
  }

  public function rules()
  {
    return [
    'blog_title' => 'required',
    'blog_cont' => 'required',
    'featured_image' => 'required|mimes:png,jpg,jpeg'
  ];
  }

}
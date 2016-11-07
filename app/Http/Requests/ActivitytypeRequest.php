<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ActivitytypeRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'activity_type' => 'required|regex:/^[(a-zA-Z\s\!-_)]+$/u',
            
        ];
    }

}

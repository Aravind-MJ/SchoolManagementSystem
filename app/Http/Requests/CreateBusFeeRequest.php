<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBusFeeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'class'        =>  'required',
			'division' 	   =>  'required',            
            'student_id'   =>  'required',
            'bus_id'       =>  'required',
            'fee'          =>  'required|numeric|min:100',
        ];
    }
}

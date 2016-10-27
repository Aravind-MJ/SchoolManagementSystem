<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBusRequest extends Request
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
            'bus_no'       =>  'required|regex:/^[(a-zA-Z0-9 )]+$/u',
            'number_plate' =>  'required|regex:/^[(a-zA-Z0-9 )]+$/u',
            'driver'       =>  'required|regex:/^[(a-zA-Z )]+$/u',
            'cleaner'      =>  'required|regex:/^[(a-zA-Z )]+$/u',
            'route'        =>  'required',
        ];
    }
}

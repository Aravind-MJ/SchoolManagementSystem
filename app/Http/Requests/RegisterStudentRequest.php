<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterStudentRequest extends Request {

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
        switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
            return [
            'first_name' => 'required|regex:/^[A-Za-z ]+$/',
            'last_name' => 'required|regex:/^[A-Za-z ]+$/',
            'class' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'guardian' => 'required',
            'religion' => 'required',
            'housename' => 'required',
            'place' => 'required',
            'district' => 'required',
            'state' => 'required',
                
                
            'phone' => 'required|regex:/^[0-9]{10}+$/',
            'school'=> 'required|regex:/^[A-Za-z. - ,]+$/',
            'email' => 'required|email|unique:users,email'
            //'photo' =>'required|mimes:jpeg,png,jpg|max:2000'
        ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
            'gender' => 'required',
            'dob' => 'required',
            'guardian' => 'required',
            'housename' => 'required',
            'place' => 'required',
            'district' => 'required',
         
            'phone' => 'required|regex:/[0-9]{10}/',
            'school' => 'required|regex:/^[A-Za-z. - ,]+$/'
        ];


        }
        default:break;
    }
        
    }

}

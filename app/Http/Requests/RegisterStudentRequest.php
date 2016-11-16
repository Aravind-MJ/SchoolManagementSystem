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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'class' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'guardian' => 'required',
            'religion' => 'required',
//            'category' => 'required',
            'hostelfee' => 'required',
            'housename' => 'required',
            'place' => 'required',
            'district' => 'required',
            'state' => 'required',
            'phone' => 'required|regex:/[0-9]{10}/',
            'school' => 'required|regex:/^[A-Za-z. - ,]+$/',
            'email' => 'required|email|unique:users,email',
            'photo' =>'required|mimes:jpeg,png,jpg|max:2000'
        ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
            'class' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'guardian' => 'required',
            'religion' => 'required',
//            'category' => 'required',
            'hostelfee' => 'required',
            'housename' => 'required',
            'place' => 'required',
            'district' => 'required',
            'state' => 'required',
            'phone' => 'required|regex:/[0-9]{10}/',
            'school' => 'required|regex:/^[A-Za-z. - ,]+$/',
            'photo' =>'mimes:jpeg,png,jpg|max:2000'
        
        ];


        }
        default:break;
    }
        
    }

}

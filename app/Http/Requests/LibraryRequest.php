<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LibraryRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'bookno' => 'required|numeric|min:0|max:1000000',
                        'title' => 'required',                       
                        'author' => 'required|alpha',
                        'edition' => 'required',
                        'subject' => 'required',
                        'publisher' => 'required',
                        'quantity' => 'required|numeric|min:0|max:1000000',
                        'bookcost' => 'required|numeric|min:0|max:1000000',
                        'language' => 'required|alpha'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'bookno' => 'required|numeric|min:0|max:1000000',
                        'title' => 'required',                       
                        'author' => 'required',
                        'edition' => 'required',
                        'subject' => 'required',
                        'publisher' => 'required',
                        'quantity' => 'required|numeric|min:0|max:1000000',
                        'bookcost' => 'required|numeric|min:0|max:1000000',
                        'language' => 'required|alpha'
                    ];
                }
            default:break;
        }
    }
}

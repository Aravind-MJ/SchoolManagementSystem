<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PublishClassdetailsRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'class' => 'required',
                        'division' => 'required',
                        'year' => 'required',
                        'in_charge' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'class' => 'required',
                        'division' => 'required',
                        'year' => 'required',
                        'in_charge' => 'required',
                    ];
                }
            default:break;
        }
    }

}

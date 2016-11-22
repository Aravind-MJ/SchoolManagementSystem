<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreManagementRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function rules() {
       return [
            'item_brand'       =>  'required|regex:/^[(a-zA-Z\s\!-_)]+$/u' ,
            'item_cost'        =>  'required|numeric|min:1|max:1000000' ,
            //'item_detail'      =>  'required|regex:/^[(a-zA-Z\s\!-_)]+$/u' ,
            'item_stock'       =>  'required|numeric|min:0|max:1000000'  ,
            'item_limit'       =>  'required|numeric|min:5|max:100000'  ,
        ];
    }

}

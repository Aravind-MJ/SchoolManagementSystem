<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TimetableConfigRequest extends Request
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
            'no_of_days_week' => 'required',
            'no_of_hours_day' => 'required',
            'section' => 'required'
        ];
    }
}

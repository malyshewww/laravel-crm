<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'person_surname' => 'required',
            'person_name' => 'required',
            'person_gender' => 'required',
            'person_nationality' => 'required',
            'person_birthday' => 'required',
        ];
    }
}

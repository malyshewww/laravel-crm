<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimRequest extends FormRequest
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
            'date_start' => 'required',
            'date_end' => 'required',
            'comment' => 'nullable',
            'manager' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'date_start.required' => 'A date_start is required',
            'date_end.required' => 'A date_end is required',
        ];
    }
}

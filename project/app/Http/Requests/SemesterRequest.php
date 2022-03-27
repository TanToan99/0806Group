<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
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
            'name' => 'required|string|unique:semesters|max:255',
            'end_day' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name semester is required',
            'name.unique' => 'The name semester is already',
            'and_day.required' =>'The deadline is required',
            'name.max' => 'The name semester is too long, please try again'
        ];        
    }
}

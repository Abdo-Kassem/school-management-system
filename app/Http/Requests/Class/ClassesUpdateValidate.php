<?php

namespace App\Http\Requests\Class;

use Illuminate\Foundation\Http\FormRequest;

class ClassesUpdateValidate extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'gradeID' => 'required|numeric'
        ];
    }

    public function messages() 
    {
        return [
            'name_ar.required' => __('validation.required'),
            'name_ar.string' => __('validation.string'),
            'name_en.required' => __('validation.required'),
            'name_en.string' => __('validation.string'),
            'gradeID.required' => __('validation.required'),
            'gradeID.numeric' => __('validation.numeric')
        ];
    }

}

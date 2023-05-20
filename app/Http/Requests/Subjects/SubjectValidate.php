<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class SubjectValidate extends FormRequest
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
            'name_ar' => 'required|regex:/^[\p{Arabic}\s]+$/u',
            'name_en' => 'required|string',
            'gradeID' => 'required|numeric',
            'classID' => 'required|numeric',
            'teacherID' => 'required|numeric'
        ];
    }

    public function messages() 
    {
        return [
            'name_ar.regex' => __('messages.string.regex'),
        ];
    }

}

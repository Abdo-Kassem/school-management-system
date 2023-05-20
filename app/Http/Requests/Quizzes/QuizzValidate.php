<?php

namespace App\Http\Requests\Quizzes;

use Illuminate\Foundation\Http\FormRequest;

class QuizzValidate extends FormRequest
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
            'classroomID' => 'required|numeric',
            'subjectID' => 'required|numeric',
            'teacherID' => 'nullable|numeric'
        ];
    }

    public function messages() 
    {
        return [
            'name_ar.regex' => __('messages.string.regex'),
        ];
    }

}

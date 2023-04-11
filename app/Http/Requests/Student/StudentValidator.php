<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentValidator extends FormRequest
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
        return array_merge(
            [
                'name_ar' => 'required|regex:/^[\p{Arabic}\s]+$/u',
                'name_en' => 'required|regex:/^[A-Za-z\s]+$/',
                'email' => 'required|email|unique:students,email,'.$this->studentID,
                'address' => 'required',
                'birthDate' => 'required|date|date_format:Y-m-d',
                'gender' => 'required|alpha',
                'acadimy_year' => 'required',
                'religionID' => 'required|numeric',
                'nationalityID' => 'required|numeric',
                'bloodID' => 'required|numeric',
                'parentID' => 'required|numeric',
                'gradeID' => 'required|numeric',
                'classroomID' => 'required',
            ],$this->checkIfUpdateOrCreate());
    }

    public function messages()
    {
        return [
            'password.regex' => trans('messages.password.regex'),
            'email.unique' => trans('messages.email.unique'),
            'name_ar.regex' => trans('messages.string.regex'),
            'name_en.regex' => trans('messages.string.regex'),
        ];
    }

    private function checkIfUpdateOrCreate()
    {
        if(isset($this->create))
            return ['password' => 'required|string|regex:/^[A-Z]{2,}[a-z]{2,}[0-9]{4,}$/'];
        return [];
    }
}

<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherValidation extends FormRequest
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
            'email' => 'required|email|unique:teachers,email,'.$this->teacherID,
            'name_ar' => 'required|regex:/^[\p{Arabic}\s]+$/u',
            'name_en' => 'required|regex:/^[A-Za-z\s]+$/',
            'salary' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required|alpha',
            'specializationID' => 'required|numeric',
            'gradeID' => 'required|numeric',
            'phone' => 'required|digits_between:10,11|unique:teachers,phone,'.$this->teacherID
        ];
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
}

<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class BookValidate extends FormRequest
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
            'title_ar' => 'required|regex:/^[\p{Arabic}\s]+$/u',
            'title_en' => 'required|string',
            'gradeID' => 'required|numeric',
            'classID' => 'required|numeric',
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

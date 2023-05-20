<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudyFeesValidator extends FormRequest
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
        return 
            [
                'name_ar' => 'required|regex:/^[\p{Arabic}\s]+$/u',
                'name_en' => 'required|regex:/^[A-Za-z\s]+$/',
                'gradeID' => 'required|numeric',
                'classID' => 'required|numeric|unique:study_fees,type,'.$this->feesID,
                'acadimic_year' => 'required|numeric',
                'notes' => 'required',
                'cost' => 'required|numeric',
                'type' => 'required|numeric'
                
            ];
    }

    public function messages()
    {
        return [
            'name_ar.regex' => trans('messages.string.regex'),
            'name_en.regex' => trans('messages.string.regex'),
        ];
    }

}

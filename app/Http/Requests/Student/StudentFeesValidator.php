<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentFeesValidator extends FormRequest
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
                
                'studentID' => 'required|numeric',
                'studyFeesID' => 'required|numeric',
                'credit' => 'required|numeric',
                'debit' => 'required|numeric|lte:credit',
                
            ];
    }


}

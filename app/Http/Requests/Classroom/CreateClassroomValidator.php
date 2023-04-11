<?php

namespace App\Http\Requests\Classroom;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassroomValidator extends FormRequest
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
            'list_classrooms.*.name_ar' => 'required|string',
            'list_classrooms.*.name_en' => 'required|string',
            'list_classrooms.*.gradeID' => 'required|numeric',
            'list_classrooms.*.classesID' => 'required|numeric',
        ];
    }

}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends FormRequest
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
            'name'=> 'required|regex:/^[A-Za-z]+[\sA-Za-z]*$/',
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->id(),
            'password' => 'required|regex:/^[A-Z]+[0-9]{6,}[A-Z]+$/',   
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => trans('messages.password.regex'),
            'email.unique' => trans('messages.email.unique'),
            'name.regex' => trans('messages.string.regex')
        ];
    }
}

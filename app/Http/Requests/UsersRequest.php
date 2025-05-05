<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
//            'username' => 'required|unique:users,username',
//            'email' => 'required|email|unique:users,email',
            'password' => 'required',
//            'phone' => 'required',
//            'gender' => 'required',
//            'department' => 'required',
//            'major' => 'required',
//            'year' => 'required',
//            'student_id' => 'required',
        ];
    }
}

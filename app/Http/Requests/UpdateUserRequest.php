<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required|unique:users',
            'username'=> Rule::unique('users')->ignore(request()->user),
            'email'=>'required |email',
            'email'=> Rule::unique('users')->ignore(request()->user),
            'role'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'role.required'=>'نقش کاربر را مشخص کنید.'
        ];
    }
}

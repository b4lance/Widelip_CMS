<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required'=>'El campo nombre es requerido',
            'last_name.required'=>'El campo apellido es requerido',
            'username.required'=>'El campo usuario es requerido',
            'username.string'=>'El campo usuario solo acepta letras y numeros',
            'username.unique'=>'El usuario ingresado ya se encuentra registrado',
            'email.required'=>'El campo email es requerido',
            'email.email'=>'El campo email solo acepta el formato example@example.com',
            'email.unique'=>'El email ingresado ya se encuentra registrado',
            'role.required'=>'El campo rol es requerido',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'last_name'=>'required',
            'username'=>'required|string|unique:users,username,'.$this->user,
            'email'=>'required|email|unique:users,email,'.$this->user,
            'role'=>'required',
        ];
    }
}

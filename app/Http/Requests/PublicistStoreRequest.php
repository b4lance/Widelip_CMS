<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicistStoreRequest extends FormRequest
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
            'lastname.required'=>'El campo apellido es requerido',
            'college.required'=>'El campo universidad es requerido',
            'biography.required'=>'El campo biografia es requerido',
            'file.required'=>'El Documento es requerido',
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
            'lastname'=>'required',
            'college'=>'required',
            'biography'=>'required',
            'file'=>'required',  
        ];
    }
}

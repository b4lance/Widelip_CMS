<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
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
            'slug.required'=>'El campo URL es requerido',
            'slug.unique'=>'La Url ya existe en la base de datos intente de nuevo',
            'type.required'=>'Seleccione el tipo de etiqueta'
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
            'slug'=>'required|unique:tags,slug',
            'type'=>'required'
        ];
    }
}

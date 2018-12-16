<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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


    public function messages(){
        return [
            'category_id.required'=>'El campo categoria es requerido',
            'name.required'=>'El campo titulo es requerido',
            'name.string'=>'El campo nombre solo acepta letras y numeros',
            'slug.required'=>'El campo URL es requerido',
            'slug.unique'=>'El campo URL ya existe, intenta con otro nuevamente',
            'excerpt.required'=>'El campo descripcion es requerido',
            'body.required'=>'El campo contenido es requerido',
            'file.required'=>'La imagen es requerida',
            'file.mimes'=>'La imagen solo acepta dormatos jpg,jpeg y png',
            'tag_id.required'=>'Seleccione almenos una etiqueta para continuar'
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
            'name'=>'required|string',
            'slug'=>'required|unique:posts,slug',
            'excerpt'=>'required',
            'body'=>'required',
            'category_id'=>'required',
            'tag_id'=>'required',
            'file'=>'required|mimes:jpeg,png',
        ];
    }
}



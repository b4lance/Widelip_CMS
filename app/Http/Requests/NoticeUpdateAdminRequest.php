<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeUpdateAdminRequest extends FormRequest
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
            'slug'=>'required|unique:notices,slug,'.$this->notice,
            'excerpt'=>'required',
            'body'=>'required',
            'category_id'=>'required|integer',
            'tag_id'=>'required|array',
            'status'=>'required',
        ];
    }
}

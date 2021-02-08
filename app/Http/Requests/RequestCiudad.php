<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCiudad extends FormRequest
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
            'departamento'=>'required|exists:departamentos,id',
            'nombre'=>'required|max:150'
        ];
    }

    public function messages(){
        return[
            'departamento.required'=>'El campo departamento es obligatorio.',
            'departamento.exists'=>'La información enviada es incorrecta.',

            'nombre.required'=>'El campo nombre es obligatorio.',
            'max.max'=>'El campo nombre debe contener 150 caracteres como máximo.'
        ];
    }
}

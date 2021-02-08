<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDepartamento extends FormRequest
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
        if($this->has('departamento')){
            return [
                'pais'=>'required|exists:paises,id',
                'nombre'=>'required|max:150|unique:departamentos,nombre,'.$this->input('departamento').',id'
            ];
        }
        return [
            'pais'=>'required|exists:paises,id',
            'nombre'=>'required|max:150|unique:departamentos,nombre'
        ];
    }

    public function messages(){
        return[
            'pais.required'=>'El campo país es obligatorio.',
            'pais.exists'=>'La información enviada es incorrecta.',
            'nombre.required'=>'El campo nombre es obligatorio.',
            'nombre.unique'=>'El elemento nombre ya está en uso',
            'max.max'=>'El campo nombre debe contener 150 caracteres como máximo.'
        ];
    }
}

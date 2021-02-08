<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestOperadorLogistico extends FormRequest
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
        if($this->has('id')){
            return [
                'nombre'=>'required|max:150|unique:operadores_logisticos,nombre,'.$this->input('id').',id',
                'prefijo'=>'required|max:20|unique:operadores_logisticos,prefijo,'.$this->input('id').',id',
                'contacto'=>'required|max:150',
                'ciudad'=>'required|exists:ciudades,id',
                'barrio'=>'required|max:250',
                'calle'=>'required_without:carrera|max:20',
                'carrera'=>'required_without:calle|max:20',
                'numero'=>'required|max:20',
                'especificaciones'=>'max:250',
            ];
        }
        return [
            'nombre'=>'required|max:150|unique:operadores_logisticos,nombre',
            'prefijo'=>'required|max:20|unique:operadores_logisticos,prefijo',
            'contacto'=>'required|max:150',
            'ciudad'=>'required|exists:ciudades,id',
            'barrio'=>'required|max:250',
            'calle'=>'required_without:carrera|max:20',
            'carrera'=>'required_without:calle|max:20',
            'numero'=>'required|max:20',
            'especificaciones'=>'max:250',
        ];
    }

    public function messages(){
        return[

        ];
    }
}

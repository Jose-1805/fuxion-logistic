<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMallaCobertura extends FormRequest
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
                'origen'=>'required|max:150',
                'destino'=>'required|max:150|unique:mallas_cobertura,destino,'.$this->input('id').',id',
                'tiempo_entrega'=>'required|integer',
                'operador_logistico'=>'required|exists:operadores_logisticos,id',
            ];
        }
        return [
            'origen'=>'required|max:150',
            'destino'=>'required|max:150|unique:mallas_cobertura,destino',
            'tiempo_entrega'=>'required|integer',
            'operador_logistico'=>'required|exists:operadores_logisticos,id',
        ];
    }

    public function messages(){
        return[
            'tiempo_entrega.required'=>'El campo tiempo de espera es requerido',
            'tiempo_entrega.integer'=>'El campo tiempo de espera debe ser un número entero',
        ];
    }
}

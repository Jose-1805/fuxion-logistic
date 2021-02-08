<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEstadoPedido extends FormRequest
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
                'nombre'=>'required|unique:estados_pedidos,nombre,'.$this->id.',id|max:100',
                'descripcion'=>'required|max:250',
                'plantilla_correo'=>'required_with:notificacion_correo|exists:plantillas_correos,id',
                'correos_destinatarios'=>'required_with:notificacion_correo',
            ];
        }else {
            return [
                'nombre'=>'required|unique:estados_pedidos,nombre|max:100',
                'descripcion'=>'required|max:250',
                'plantilla_correo'=>'required_with:notificacion_correo|exists:plantillas_correos,id',
                'correos_destinatarios'=>'required_with:notificacion_correo',
            ];
        }
    }

    public function messages(){
        return [
          'descripcion.required'=>'El campo descripción es requerido',
          'descripcion.max'=>'El campo descripción puede contener máximo 250 caracteres'
        ];
    }
}

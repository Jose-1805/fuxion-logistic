<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEstadoOperadorLogistico extends FormRequest
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
                'nombre'=>'required|unique:estados_operadores_logisticos,nombre,'.$this->id.',id|max:100',
                'descripcion'=>'required|max:250',
                'alias'=>'max:50',
                'plantilla_correo'=>'required_with:notificacion_correo|exists:plantillas_correos,id',
                'correos_destinatarios'=>'required_with:notificacion_correo',
                'estado_pedido'=>$this->input('estado_pedido')!=''?'exists:estados_pedidos,id':''
            ];
        }else {
            return [
                'nombre'=>'required|unique:estados_operadores_logisticos,nombre|max:100',
                'descripcion'=>'required|max:250',
                'alias'=>'max:50',
                'plantilla_correo'=>'required_with:notificacion_correo|exists:plantillas_correos,id',
                'correos_destinatarios'=>'required_with:notificacion_correo',
                'estado_pedido'=>$this->input('estado_pedido')!=''?'exists:estados_pedidos,id':''
            ];
        }
    }

    public function messages(){
        return [
            'descripcion.required'=>'El campo descripción es requerido',
            'descripcion.max'=>'El campo descripción puede contener máximo 250 caracteres',
            'estado_pedido.exists'=>'La información enviada es incorrecta'
        ];
    }
}

<?php

namespace FuxionLogistic\Http\Requests;
use FuxionLogistic\Models\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class RequestSoporteEmpresario extends FormRequest
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
        $pedido = Pedido::find($this->input('pedido'));
        $user = $pedido->empresario->user;
        return [
            'nombres'=>'required|max:150',
            'apellidos'=>'required|max:150',
            'email'=>'required|email|max:150',
            'direccion'=>'required|max:250',
            'telefono'=>'required|digits_between:6,15',
        ];
    }

    public function messages(){
        return[
            'direccion.required'=>'El campo dirección es obligatorio.',
            'direccion.max'=>'El campo dirección debe contener 250 caracteres como máximo.',
            'telefono.required'=>'El campo teléfono es obligatorio.',
            'telefono.digits_between'=>'El campo teléfono debe contener entre 6 y 15 dígitos.',
            'email.unique'=>'Ya existe un empresario con el email ingresado'
        ];
    }
}

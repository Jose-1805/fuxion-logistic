<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBodega extends FormRequest
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
        if($this->has('bodega')){
            return [
                'nombre'=>'required|unique:bodegas,nombre,'.$this->bodega.',id|max:150',
                'prefijo_facturacion'=>'required|unique:bodegas,prefijo_facturacion,'.$this->bodega.',id|max:20',
                'alias'=>'required|unique:bodegas,alias,'.$this->bodega.',id|max:150',
                'ciudad'=>'required|exists:ciudades,id',
                'barrio'=>'required|max:250',
                'calle'=>'required_without:carrera|max:20',
                'carrera'=>'required_without:calle|max:20',
                'numero'=>'required|max:20',
                'especificaciones'=>'max:250',
            ];
        }else {
            return [
                'nombre'=>'required|unique:bodegas,nombre|max:150',
                'prefijo_facturacion'=>'required|unique:bodegas,prefijo_facturacion|max:20',
                'alias'=>'required|unique:bodegas,alias|max:150',
                'alias'=>'required|unique:bodegas,alias|max:150',
                'ciudad'=>'required|exists:ciudades,id',
                'barrio'=>'required|max:250',
                'calle'=>'required_without:carrera|max:20',
                'carrera'=>'required_without:calle|max:20',
                'numero'=>'required|max:20',
                'especificaciones'=>'max:250',
            ];
        }
    }
}

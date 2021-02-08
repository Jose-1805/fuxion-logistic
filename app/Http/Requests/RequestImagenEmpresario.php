<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestImagenEmpresario extends FormRequest
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
            'imagen'=>'required|file|mimes:jpg,jpeg|max:500',
        ];
    }

    public function messages(){
        return[

            'imagen.required'=>'El campo de imagen es obligatorio',
            'imagen.file'=>'El campo de imagen es incorrecto',
            'imagen.mimes'=>'La imagen seleccionada debe ser de tipo jpg',
            'imagen.max'=>'La imagen debe pesar máximo 500 kb',
        ];
    }
}

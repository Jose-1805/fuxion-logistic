<?php

namespace FuxionLogistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPlantillaCorreo extends FormRequest
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
                'nombre'=>'required|unique:plantillas_correos,nombre,'.$this->id.',id|max:150',
                'asunto'=>'max:150',
            ];
        }else {
            return [
                'nombre'=>'required|unique:plantillas_correos,nombre',
                'asunto'=>'max:150',
            ];
        }
    }
}

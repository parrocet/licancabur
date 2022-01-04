<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GerenciasRequest extends FormRequest
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
            'gerencia'=>'required|unique:gerencias'
        ];
    }

    public function mesagges()
    {
        return [
            'gerencia.required' => 'Debe ingresar el nombre de la gerencia',
            'gerencia.unique' => 'El nombre de la gerencia ya existe'
        ];
    }
}

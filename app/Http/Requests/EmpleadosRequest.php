<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadosRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'cargo' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'email.unique' => 'El correo ya ha sido registrado a otro empleado',
            'cargo.required' => 'Debe seleccionar un cargo'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanificacionRequest extends FormRequest
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
            'elaborado' => 'required',
            'aprobado' => 'required',
            'num_contrato' => 'numeric|required',
            'fechas' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'elaborado.required' => 'Debe ingresar el nombre de quién la elaboró',
            'aprobado.required' => 'Debe ingresar el nombre de quien la aprueba',
            'num_contrato.required' => 'Debe ingresar el número de contrato',
            'num_contrato.numeric' => 'El número de contrto sólo debe contener números',
            'fechas.required' => 'Debe seleccionar una semana del año para poder obtener las fechas'
        ];
    }
}

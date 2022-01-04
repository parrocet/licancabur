<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreasEmpresa extends Model
{
    protected $table='areas_empresa';

    protected $fillable=['area_e'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_areas_empresa','id_area_e','id_empleado');
    }
}

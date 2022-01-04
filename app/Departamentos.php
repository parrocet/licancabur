<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table='departamentos';

    protected $fillable=['departamento'];

    public function actividades()
    {
    	return $this->hasMany('App\Actividades','id_departamento','id');
    }

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_departamentos','id_departamento','id_empleado');
    }
}

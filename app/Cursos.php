<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table='cursos';

    protected $fillable=['curso','status'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_cursos','id_curso','id_empleado')->withPivot('fecha','fecha_vence','status');
    }
}

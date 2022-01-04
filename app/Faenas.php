<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faenas extends Model
{
    protected $table='faenas';

    protected $fillable=['faena'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_faenas','id_faena','id_empleado');
    }
}

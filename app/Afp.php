<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afp extends Model
{
    protected $table='afp';

    protected $fillable=['afp'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_afp','id_afp','id_empleado');
    }
}

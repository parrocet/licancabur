<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionContacto extends Model
{
    protected $table='informacion_contacto';

    protected $fillable=['id_empleado','nombre','apellido','telefono','email','direccion'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleados','id_empleado');
    }
}

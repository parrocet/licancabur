<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosVarios extends Model
{
    protected $table='datos_varios';

    protected $fillable=['id_empleado','segundo_nombre','segundo_apellido','fecha_nac'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleados','id_empleado');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table='notas';

    protected $fillable=['id_empleado','notas','fecha'];

    public function empleado()
	{
		return $this->belongsTo('App\Empleados','id_empleado');
	}
}

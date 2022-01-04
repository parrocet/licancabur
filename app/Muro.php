<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muro extends Model
{
    protected $table='muros';

    protected $fillable=['id_empleado','comentario','fecha','hora'];

    public function empleado()
	{
		return $this->belongsTo('App\Empleados','id_empleado');
	}
}

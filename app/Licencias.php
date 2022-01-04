<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencias extends Model
{
    protected $table='licencias';

    protected $fillable=['licencia','status'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_licencias','id_licencia','id_empleados')->withPivot('fecha','fecha_vence','status');
    }
}

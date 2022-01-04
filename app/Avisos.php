<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avisos extends Model
{
    protected $table='avisos';

    protected $fillable=['motivo','mensaje','dias_previos','dias_post','modalidad'];

    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','avisos_enviados','id_aviso','id_empleado')->withPivot('status','created_at');
    }
}

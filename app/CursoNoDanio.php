<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoNoDanio extends Model
{
    protected $table='curso_cero_danio';

    protected $fillable=['id_empleado','status','fecha_presentacion','mes','observacion'];

    public function empleados()
    {
    	return $this->belongsTo('App\Empleados','id_empleado');
    }
}

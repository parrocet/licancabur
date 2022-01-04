<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
    protected $table='planificacion';

    protected $fillable=['elaborado','aprobado','num_contrato','fechas','semana','revision','id_gerencia'];

    public function actividades()
    {
    	return $this->hasMany('App\Actividades','id_planificacion','id');
    }

    public function archivos()
    {
    	return $this->hasMany('App\ArchivosPlan','id_planificacion','id');
    }

    public function avances()
    {
    	return $this->hasMany('App\Avances','id_planificacion','id');
    }

    public function gerencias()
    {
        return $this->belongsTo('App\Gerencias','id_gerencia');
    }

    public function elaborados()
    {
        return $this->belongsTo('App\Empleados','id_elaborado');
    }

    public function aprobados()
    {
        return $this->belongsTo('App\Empleados','id_aprobado');
    }
}

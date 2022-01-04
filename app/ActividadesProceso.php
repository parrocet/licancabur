<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesProceso extends Model
{
    protected $table='actividades_proceso';

    protected $fillable=['id_actividad','id_empleado','hora_inicio','hora_finalizada','status'];

    public function comentarios()
    {
    	return $this->hasMany('App\Comentarios','id_actv_proceso','id');
    }

    public function archivos()
    {
    	return $this->hasMany('App\ActividadesAdjuntos','id_actv_proceso','id');
    }

    public function actividad()
    {
        return $this->belongsTo('App\Actividades','id_actividad','id');
    }
}

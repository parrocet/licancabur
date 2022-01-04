<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesAdjuntos extends Model
{
    protected $table='actividades_adjuntos';

    protected $fillable=['id_actv_proceso','id_usuario','nombre','url','tipo'];

    public function actividades()
    {
    	return $this->belongsTo('App\ActividadesProceso','id_actv_proceso');
    }

    public function usuarios()
    {
    	return $this->belongsTo('App\User','id_usuario');
    }
}

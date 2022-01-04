<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesVistas extends Model
{
    protected $table='actividades_vistas';

    protected $fillable=['id_actividad','status'];

    public function actividades()
    {
    	return $this->belongsTo('App\Actividades','id_actividad');
    }
}

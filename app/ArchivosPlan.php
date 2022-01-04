<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivosPlan extends Model
{
    protected $table='actividades_has_archivos';

    protected $fillable=['id_actividad','nombre','url','tipo'];

    public function actividades()
    {
    	return $this->belongsTo('App\Actividades','id_actividad');
    }
}

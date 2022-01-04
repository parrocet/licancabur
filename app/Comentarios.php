<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table='actividades_comentarios';

    protected $fillable=['id_actv_proceso','id_usuario','comentario'];

    public function actividad_proceso()
    {
    	return $this->belongsTo('App\ActividadesProceso','id_actv_proceso');
    }

    public function usuarios()
    {
    	return $this->belongsTo('App\User','id_usuario');
    }

    public function vistos()
    {
        return $this->hasMany('App\ComentariosVistos','id_comentario','id');
    }
}

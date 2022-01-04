<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gerencias extends Model
{
    protected $table='gerencias';

    protected $fillable=['gerencia'];


    public function planificacion()
    {
    	return $this->hasMany('App\Planificacion','id_gerencia','id');
    }

}

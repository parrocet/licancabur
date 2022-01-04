<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isapre extends Model
{
    protected $table='isapre';

    protected $fillable=['id','isapre'];


    public function empleados()
    {
    	return $this->belongsToMany('App\Empleados','empleados_has_ispare','id_isapre','id_empleado');
    }
}

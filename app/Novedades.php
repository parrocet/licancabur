<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedades extends Model
{
    protected $table='novedades';
    protected $fillable=['titulo','novedad','tipo','fecha','hora','id_usuario_n','id_empleado'];

    public function usuario()
    {
    	return $this->belongsTo('App\User','id_usuario_n','id');
    }
    
    public function empleado()
    {
    	return $this->belongsTo('App\Empleados','id_empleado','id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table='empleados';

    protected $fillable=['nombres','apellidos','id_usuario','email','rut','edad','cargo','genero','turno','status'];

    public function areas()
    {
    	return $this->belongsToMany('App\Areas','empleados_has_areas','id_empleado','id_area');
    }

    public function actividades()
    {
    	return $this->belongsToMany('App\Actividades','actividades_proceso','id_empleado','id_actividad')->withPivot('hora_inicio','hora_finalizada','status');
    }
    public function usuario()
    {
        return $this->belongsTo('App\User','id_usuario');
    }

    public function departamentos()
    {
        return $this->belongsToMany('App\Departamentos','empleados_has_departamentos','id_empleado','id_departamento');   
    }
    public function examenes()
    {
        return $this->belongsToMany('App\Examenes','empleados_has_examenes','id_empleado','id_examen')->withPivot('fecha','fecha_vence','status');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Cursos','empleados_has_cursos','id_empleado','id_curso')->withPivot('fecha','fecha_vence','status');
    }

    public function licencias()
    {
        return $this->belongsToMany('App\Licencias','empleados_has_licencias','id_empleado','id_licencia')->withPivot('fecha','fecha_vence','status');
    }

    public function faenas()
    {
        return $this->belongsToMany('App\Faenas','empleados_has_faenas','id_empleado','id_faena');
    }
    public function afp()
    {
        return $this->belongsToMany('App\Afp','empleados_has_afp','id_empleado','id_afp');
    }
    public function areasempresa()
    {
        return $this->belongsToMany('App\AreasEmpresa','empleados_has_areas_empresa','id_empleado','id_area_e');
    }
    public function isapre()
    {
        return $this->belongsToMany('App\Isapre','empleados_has_isapre','id_empleado','id_isapre');
    }

    public function datoslaborales()
    {
        return $this->hasOne('App\DatosLaborales','id_empleado','id');
    }
    public function notas()
    {
        return $this->hasMany('App\Notas','id_empleado','id');
    }
    public function muro()
    {
        return $this->hasMany('App\Muro','id_empleado','id');
    }

    public function novedades()
    {
        return $this->hasMany('App\Novedades','id_empleado','id');
    }

    public function avisos()
    {
        return $this->belongsToMany('App\Avisos','avisos_enviados','id_empleado','id_aviso')->withPivot('status','created_at');
    }

    public function datosvarios()
    {
        return $this->hasOne('App\DatosVarios','id_empleado','id');
    }

    public function contacto()
    {
        return $this->hasOne('App\InformacionContacto','id_empleado','id');
    }

    public function planificacionA()
    {
        return $this->hasMany('App\Planificacion','id_aprobado','id');
    }

    public function planificacionE()
    {
        return $this->hasMany('App\Planificacion','id_elaborado','id');
    }
}

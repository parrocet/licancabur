  
@extends('layouts.appLayout')

@section('breadcomb')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Crear actividad</h2>
                                    <p>Ver actividades de la semana actual | registrar actividad.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <strong style="float: right; margin-top: 10px; margin-bottom: 5px;">Año laboral actual: {{-- {{ config('session.fecha_actual') }} --}} 
                                @if(session('fecha_actual'))
                                    @php $anio=session('fecha_actual'); @endphp
                                @else
                                    @php $anio=date('Y');
                                        session('fecha_actual',$anio);
                                     @endphp
                                    
                                @endif
                                {{ $anio }}
                            </strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="pull-right">
                                @if(buscar_p('Actividades','Registrar')=="Si" || buscar_p('Actividades','Registro de PM03')=="Si")
                                <button id="actividad" value="0" data-toggle="modal" data-target="#crear_actividad" class="btn btn-default" data-backdrop="static" data-keyboard="false"><i class="notika-icon notika-edit"></i> Nueva actividad---</button>
                                @endif
                            </div>
                        </div>
                        @include('planificacion.modales.crear_actividad')
                        @include('planificacion.modales.cerrar_modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
@endsection

@section('content')
@if(\Auth::User()->tipo_user=="Empleado")
    @include('planificacion.fullcalendar')
@elseif(\Auth::User()->tipo_user!="Empleado")
<!-- Form Element area Start-->
<div class="form-element-area modals-single">
    <div class="container" style="width: ;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        @if(!empty($planificacion1))
                        <p>Actividades - Información detallada de la semana {{ $planificacion1->semana }}</p>
                        @else

                        <p>No existe planificación registrada para la semana actual</p>

                        @endif
                        @if(count($errors))
                        <div class="alert-list m-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        @endif
                        @include('flash::message')
                    </div>
                   {!! Form::open(['route' => ['actividades.buscar_actividades_semana_actual'],'method' => 'post']) !!}
                        @csrf 
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <label for="gerencias"><b style="color: red;">*</b> Gerencias:</label>
                                    <select class="form-control" name="id_gerencia_search" id="id_gerencia_search">
                                        <option value="0">Seleccione una gerencia</option>
                                        @foreach($gerencias as $key)
                                        <option value="{{ $key->id }}">{{ $key->gerencia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <label for="areas"><b style="color: red;">*</b> Areas:</label>
                                    <select name="id_area_search" id="id_area_search" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-search"></i>
                                </div>
                                <div class="nk-int-st">
                                    <br>
                                    <button class="btn btn-md btn-default" id="buscar_actividades">Buscar Actividades</button>
                                    <span id="mensaje_error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            @if(!empty($planificacion1) && $envio==0)
                            <div class="row" style="/*background: #7dcfee;*/ margin: 5px; padding: 15px;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">                    
                                            <div class="nk-int-st">
                                            <b>Gerencia: {{ $planificacion1->gerencias->gerencia }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">                    
                                            <div class="nk-int-st">
                                            <b>Elaborado: {{ $planificacion1->elaborado }}</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">
                                            <b>Aprobado: {{ $planificacion1->aprobado }}</b>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">
                                            <b>Número de contrato: {{ $planificacion1->num_contrato }}</b>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">
                                            <b>Semana: {{ $planificacion1->semana }}</b>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">
                                            <b>Revision: {{ $planificacion1->revision }}</b>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group ic-cmp-int">
                                            <b>Fechas: {{ $planificacion1->fechas }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif(empty($planificacion1) && $envio==0)
                                <p>No existe planificación registrada para ésta gerencia</p>
                            @endif
                            <div class="panel-body">
                            @if(buscar_actividades_area($num_semana_actual,$id_area)=="Si" && $envio==0)
                            <p>                                                                            
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="normal-table-list mg-t-30">
                                            <div class="basic-tb-hd">
                                                <h2>Totales de Duración de Horas semanales</h2>
                                            </div>
                                            <div class="bsc-tbl-bdr">
                                                <table class="table table-bordered" border="2">
                                                    <thead>
                                                        <tr class="" style="/*background: #7dcfee;*/">
                                                            <th>Duraciones/Días</th>
                                                            <th>Miércoles</th>
                                                            <th>Jueves</th>
                                                            <th>Viernes</th>
                                                            <th>Sábado</th>
                                                            <th>Domingo</th>
                                                            <th>Lunes</th>
                                                            <th>Martes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty(tiempos($planificacion1,$id_area)))
                                                        @php $tiempos=tiempos($planificacion1,$id_area) @endphp
                                                        @for($i=0;$i<2;$i++)

                                                        <tr>
                                                            @for($j=0;$j<8;$j++)
                                                            <td class="" style="/*background: #7dcfee;*/" scope="row">{{ $tiempos[$i][$j] }}</td>
                                                            @endfor
                                                        </tr>
                                                        @endfor
                                                        @else
                                                            Sin datos para mostrar
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               {!! Form::open(['route' => ['asignacion_multiple'],'method' => 'post']) !!}
                                        @csrf 
                                <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-example-int form-example-st">
                                                <div class="form-group">
                                                    <select name="id_empleado" id="id_empleado_multi" class="form-control" required="">
                                                        @foreach($empleados as $key)
                                                        <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} | RUT: {{$key->rut}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <div class="form-example-int form-example-st">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-default btn mb-3">Asignar actividades</button>
                                                </div>
                                            </div>
                                        </div>
                                                                        
                                </div>
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="data-table-list">
                                            <div class="table-responsive">
                                                <table id="data-table-basic" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>.</th>
                                                            <th>Task</th>
                                                            <th>Fecha</th>
                                                            <th>Día</th>
                                                            <th>Área</th>
                                                            <th>Departamento</th>
                                                            <th>Tipo</th>
                                                            <th>Realizada</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    @php $i=1; @endphp
                                                    @foreach($actividades as $key)
                                                    @if($key->id_area==$id_area)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <div class="form-group text-center">
                                                                 <input type="checkbox" name="id_actividad[]" id="id_actividad_multi" value="{{ $key->id }}" class="i-checks">
                                                            </div>
                                                           
                                                        </td>
                                                        <td width="25%">{{ $key->task }}</td>
                                                        {{-- 
                                                        <td>{{ $key->descripcion }}</td>
                                                        <td>{{ $key->duracion_pro }}</td>
                                                        <td>{{ $key->cant_personas }}</td>
                                                        <td>{{ $key->duracion_real }}</td>
                                                        <td>{{ $key->observacion1 }}</td>
                                                        <td>{{ $key->observacion2 }}</td>
                                                        --}}
                                                        <td>{{ $key->fecha_vencimiento }}</td>
                                                        <td>{{ $key->dia }}</td>
                                                        <td>{{ $key->areas->area }}</td>
                                                        <td>{{ $key->departamentos->departamento }}</td>
                                                        <td>{{ $key->tipo }}</td>
                                                        <td>{{ $key->realizada }}</td>
                                                        <td>
                                                            @if(buscar_p('Actividades','Ver')=="Si")
                                                            <button onclick="ver_actividad('{{ $key->id }}','{{ $key->task }}','{{ $key->fecha_vencimiento }}'
                                                            // ,'{{ $key->descripcion }}'
                                                            ,'{{ $key->duracion_pro }}','{{ $key->cant_personas }}','{{ $key->duracion_real }}','{{ $key->dia }}','{{ $key->tipo }}','{{ $key->realizada }}','{{ $key->areas->area }}','{{ $key->observacion2 }}','{{ $key->departamentos->departamento }}')" type="button" class="btn btn-info" data-toggle="modal" data-target="#ver_actividad"><i class="fa fa-search"></i> </button>
                                                            @endif
                                                            @if(buscar_p('Actividades','Modificar')=="Si")
                                                            <button onclick="editar_act({{ $key->id }},'{{$key->dia}}')" type="button" class="btn btn-info" data-toggle="modal" data-target="#crear_actividad"><i class="fa fa-edit"></i> </button>
                                                            @endif
                                                            
                                                            @if(buscar_p('Actividades','Asignar')=="Si")
                                                            <button onclick="asignar({{ $key->id }},{{ $key->id_area }},'{{ $key->task }}')" type="button" class="btn btn-success" data-toggle="modal" data-target="#asignar_tarea"><i class="fa fa-user"></i> </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    
                                                    @endif
                                                    @endforeach    
                                                    </tbody>    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </p>
                            {!! Form::close() !!}
                            </div>
                            @elseif(buscar_actividades_area($num_semana_actual,$id_area)=="No" && $envio==0)
                                <p>No se encontró planificación registrada para ésta área </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@include('planificacion.modales.eliminar')
@include('planificacion.modales.asignar_tarea')
@include('planificacion.modales.clave_root_eliminar')
@include('planificacion.modales.ver_actividad')

@endsection

@section('scripts')
<script type="text/javascript">
    console.log("--------------");
    function ModalTwo(){
        $('#myModaltwo').modal('hide');
        $('#myModaltwo').on('hidden', function () {
            $('#claverrot').modal('show')
        });
    }
</script>
<script type="text/javascript">
$(document).ready( function(){
    console.log("obj");
    //------ realizando busqueda de las actividades deacuerdo al filtro
        //select dinámico
        $("#id_gerencia_search").on("change",function (event) {
            console.log("select dinámico");
            var id_gerencia=event.target.value;
            
            $.get("/planificacion/"+id_gerencia+"/buscar",function (data) {
                
                $("#id_area_search").empty();
            
            if(data.length > 0){
                for (var i = 0; i < data.length ; i++) 
                {
                    console.log('trae');
                    $("#id_area_search").removeAttr('disabled');
                    $("#id_area_search").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }
            }else{
                
                $("#id_area_search").attr('disabled', false);
                console.log('No trae');
            }
            });
        });
        
    //-----------------------------------------
    
    $("#id_planificacion").attr('multiple',true);
    $('#id_planificacion').replaceWith($('#id_planificacion').clone().attr('name', 'id_planificacion[]'));
    
    $("#tipo1").on('change',function (event) { 
    console.log("entro");
        var tipo1=event.target.value;        
        if (tipo1=="PM02") {
            $("#pm02").removeAttr('style');
            $("#departamentos").css('display','none');
            $("#departamentos option").val(1).attr('selected',true);
                
        }else{
            if (tipo1=="PM03") {
                $("#departamentos").css('display','block');
                $("#departamentos option").val(1).attr('selected',true);
            } else{
                $("#departamentos").css('display','none');
                $("#departamentos option").val(1).attr('selected',true);
            }
            $("#pm02").css('display','none');
            $("#des_actividad").removeAttr('style');
            $("#areas").css('display','block');
            $("#tab2").removeAttr('style');           
              
        }
    });
    $("#id_actividad").on('change',function (event) {
        console.log("act");     
        var id_actividad=event.target.value;
        
        if (id_actividad!=="0") {
            $("#areas").css('display','none');
            $("#des_actividad").css('display','none');
            //$("#des_actividad").empty();
            //$("#des_actividad").detach();
            $("#tab2").css('display','none');
            $("#task1").removeAttr('required');
            $("#cant_personas1").removeAttr('required');
        }else{
            console.log("entra");
            $("#areas").css('display','block');
            $("#tab2").removeAttr('style');
            $("#des_actividad").removeAttr('style');
            //$("#des_actividad").css('display','block');
        }
    });

    $("#actividad").on('click',function (event) {
        
        var actividad=event.target.value;
        console.log("entro aqui");
        if (actividad==0) {
            $("#accion").text('Registrar');
            $("#id_actividad_act").val("");
        }
//------------------------------------------------------------------DISPLAY CHECK AND NONE RADIO
            $("#area_radio").css('display','none');
                $("#miercoles_r").prop('disabled',true);
                $("#jueves_r").prop('disabled',true);
                $("#viernes_r").prop('disabled',true);
                $("#sabado_r").prop('disabled',true);
                $("#domingo_r").prop('disabled',true);
                $("#lunes_r").prop('disabled',true);
                $("#martes_r").prop('disabled',true);
            $("#area_check").css('display','block');
                $("#mie").prop('disabled',false);
                $("#jue").prop('disabled',false);
                $("#vie").prop('disabled',false);
                $("#sab").prop('disabled',false);
                $("#dom").prop('disabled',false);
                $("#lun").prop('disabled',false);
                $("#mar").prop('disabled',false);
//------FINISH
    // $("#mie").replaceWith($('#mie').clone().attr('type', 'checkbox'));
    // $("#jue").replaceWith($('#jue').clone().attr('type', 'checkbox'));
    // $("#vie").replaceWith($('#vie').clone().attr('type', 'checkbox'));
    // $("#sab").replaceWith($('#sab').clone().attr('type', 'checkbox'));
    // $("#dom").replaceWith($('#dom').clone().attr('type', 'checkbox'));
    // $("#lun").replaceWith($('#lun').clone().attr('type', 'checkbox'));
    // $("#mar").replaceWith($('#mar').clone().attr('type', 'checkbox'));
    });
    var id_departamento=1;
    $.get("/actividades/"+id_departamento+"/buscar_departamentos",function (data) {
        
        if (data.length>0) {
            $("#id_departamento").empty();
            for (var i = 0; i < data.length; i++) {
                $("#id_departamento").append("<option value='"+data[i].id+"'>"+data[i].departamento+"</option>");
            }
        }
    });
});
function editar_act(id_actividad,dia) {
        
        $("#accion").text('Actualizar');
        
        $("#id_actividad_act").val(id_actividad);
        $.get("/actividades/"+id_actividad+"/edit",function (data) {
                
                //console.log(data[0].tipo);
                //agregando tipo en select
                $("#tipo1").empty();
                switch(data[0].tipo){
                    case 'PM01':
                        $("#tipo1").append('<option value="PM01" selected="selected">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04">PM04</option>');
                    break;
                    case 'PM02':
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02" selected="selected">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04">PM04</option>');
                    break;
                    case 'PM03':
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03" selected="selected">PM03</option>');
                        $("#tipo1").append('<option value="PM04">PM04</option>');
                    break;
                    case 'PM04':
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04" selected="selected">PM04</option>');
                    break;
                }
                //seleccionando opcion de actividades
            $("#id_actividad option").each(function(){
                if ($(this).text()==data[0].task) {
                
                    $(this).attr("selected",true);
               }
            });
            
                
            $("#observacion1").val(data[0].observacion1);
            $("#observacion2").val(data[0].observacion2);
            $("#id_planificacion").attr('multiple',false);
            $('#id_planificacion').replaceWith($('#id_planificacion').clone().attr('name', 'id_planificacion'));
            
            $("#id_planificacion option").each(function(){
                if ($(this).val()==data[0].id_planificacion) {
                
                    $(this).attr("selected",true);
                }
            });
            $("#id_area option").each(function(){
                if ($(this).val()==data[0].id_area) {
                
                    $(this).attr("selected",true);
                }
            });
            //campos en caracteristicas
            $("#task1").val(data[0].task);
            $("#descripcion").val(data[0].descripcion);
            $("#duracion_pro").val(data[0].duracion_pro);
            $("#duracion_real").val(data[0].duracion_real);
            $("#cant_personas1").val(data[0].cant_personas);
            
            
            /*$('input:radio[name=dia]').each(function() { 
                
                
                if($('input:radio[name=dia]').is(':checked')) {  
                    $('input:radio[name=dia]').attr('checked', false);
                } else {  
                    $('input:radio[name=dia]').attr('checked', false);
                }
            });*/
//------------------------------------------------------------------DISPLAY RADIO AND NONE CHECK
            $("#area_radio").css('display','block');
                $("#miercoles_r").prop('disabled',false);
                $("#jueves_r").prop('disabled',false);
                $("#viernes_r").prop('disabled',false);
                $("#sabado_r").prop('disabled',false);
                $("#domingo_r").prop('disabled',false);
                $("#lunes_r").prop('disabled',false);
                $("#martes_r").prop('disabled',false);
            $("#area_check").css('display','none');
                $("#mie").prop('disabled',true);
                $("#jue").prop('disabled',true);
                $("#vie").prop('disabled',true);
                $("#sab").prop('disabled',true);
                $("#dom").prop('disabled',true);
                $("#lun").prop('disabled',true);
                $("#mar").prop('disabled',true);
//------FINISH
            if (dia == "Mié") {
                $("#miercoles_r").prop('checked',true);
            }
            if (dia == "Jue") {
                $("#jueves_r").prop('checked',true);
            }
            if (dia == "Vie") {
                $("#viernes_r").prop('checked',true);
            }
            if (dia == "Sáb") {
                $("#sabado_r").prop('checked',true);
            }
            if (dia == "Dom") {
                $("#domingo_r").prop('checked',true);
            }
            if (dia == "Lun") {
                $("#lunes_r").prop('checked',true);
            }
            if (dia == "Mar") {
                $("#martes_r").prop('checked',true);
            }
            if($("#mie").val()==data[0].dia){
                
                $("#mie").prop('checked',true);
            }
            if($("#jue").val()==data[0].dia){
                
                $("#jue").prop('checked',true);
            }
            if($("#vie").val()==data[0].dia){
                
                $("#vie").prop('checked',true);
            }
            if($("#sab").val()==data[0].dia){
                
                $("#sab").prop('checked',true);
            }
            if($("#dom").val()==data[0].dia){
                
                $("#dom").prop('checked',true);
            }
            if($("#lun").val()==data[0].dia){
                
                $("#lun").prop('checked',true);
            }
            if($("#mar").val()==data[0].dia){
                
                $("#mar").prop('checked',true);
            }
            
            //console.log(data[0].dia);
            
            });
            //mostrando archivos cargadas a la actividad
            $.get("/actividades/"+id_actividad+"/mis_archivos",function (data) {
                //console.log(data.length);
                if (data.length!=0) {
                    $("#archivos_cargados").css('display','block');
                    $("#mis_archivos").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#mis_archivos").append("<li id='archivo'><div class='alert alert-info' role='alert'>"+data[i].nombre+" <a class='btn btn-danger pull-right' onclick='eliminar_archivo("+data[i].id+",1)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                    }
                }
            }); 
            //mostrando imágenes cargadas a la actividad
            $.get("/actividades/"+id_actividad+"/mis_imagenes",function (data) {
                //console.log(data.length);
                if (data.length!=0) {
                    $("#imagenes_cargadas").css('display','block');
                    $("#mis_imagenes").empty();
                    for (var i = 0; i < data.length; i++) {
                        //console.log(data[i].url);
                        $("#mis_imagenes").append("<li id='imagen_eliminar'><div class='alert alert-info' role='alert'><img src='{!! asset('"+ data[i].url +"') !!}' height='100px' width='100px'><a class='btn btn-danger pull-right' onclick='eliminar_archivo("+data[i].id+",2)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                        //$("#mis_imagenes").append("<li>"+data[i].url+"</li>");
                    }
                }
            }); 
}
function eliminar_archivo(id_archivo,tipo) {
        var xtipo=tipo;
        console.log(tipo);
    $.get("/actividades/"+id_archivo+"/eliminar_archivos",function (data) {
                if (data.length!=0) {
                    if (xtipo==1) {
                        console.log("cuando es archivo");
                    $("#archivos_cargados").css('display','none');
                    $("#mis_archivos").empty();
                    setTimeout(function() { $("#archivos_cargados").show(); }, 3000);
                    $('.archivos_cargados').show("slow");
                    }else{
                    $("#imagenes_cargados").css('display','none');
                    $("#mis_imagenes").empty();
                    setTimeout(function() { $("#imagenes_cargados").show(); }, 1000);
                    }
                    for (var i = 0; i < data.length; i++) {
                                                   
                    if (data[i].tipo=="file") {
                        $("#mis_archivos").append("<li><div class='alert alert-info' role='alert'>"+data[i].nombre+" <a class='btn btn-danger pull-right'  onclick='eliminar_archivo("+data[i].id+",1)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                        $("#archivo").css('display','none');
                    } else {
                        $("#mis_imagenes").append("<li id='imagen_eliminar'><div class='alert alert-info' role='alert'><img src='{!! asset('"+ data[i].url +"') !!}' height='100px' width='100px'><a class='btn btn-danger pull-right'   onclick='eliminar_archivo("+data[i].id+",2)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                    }
                    }
                }else{
                        console.log("cuando es 0 data");
                    if (xtipo==1) {
                    $("#archivos_cargados").css('display','none');
                    $("#mis_archivos").empty();
                    
                    }else{
                    $("#imagenes_cargados").css('display','none');
                    $("#mis_imagenes").empty();
                    }
                }
    });
}
function asignar(id_actividad,id_area,tarea) {
    
    $.get("/empleados/"+id_area+"/buscar",function (datos) {
        $("#id_actividad_asig").val(id_actividad);
        $("#tarea").text(tarea);
        if (datos.length>0) {
            
            $("#id_empleado").empty();
            for (var i = 0; i < datos.length; i++) {
                $("#id_empleado").append('<option value="'+datos[i].id+'">'+datos[i].apellidos+', '+datos[i].nombres+' RUT: '+datos[i].rut+'</option>');
            }
        }
    });
}
function eliminar(id_actividad) {
        $("#id_actividad_eliminar").val(id_actividad);
    }
function ver_actividad(id_actividad,task_ver,fecha_vencimiento_ver
    // ,descripcion_ver
    ,duracion_pro_ver,cant_personas_ver,duracion_real_ver,dia_ver,tipo_ver,realizada_ver,area1_ver,observacion2_ver, departamento_ver) {
    $("#task_ver").text(task_ver);
    $("#fecha_vencimiento_ver").text(fecha_vencimiento_ver);
    // $("#descripcion_ver").text(descripcion_ver);
    $("#duracion_pro_ver").text(duracion_pro_ver);
    $("#cant_personas_ver").text(cant_personas_ver);
    $("#duracion_real_ver").text(duracion_real_ver);
    $("#dia_ver").text(dia_ver);
    $("#tipo_ver").text(tipo_ver);
    $("#realizada_ver").text(realizada_ver);
    $("#area1_ver").text(area1_ver);
    $("#observacion2_ver").text(observacion2_ver);
    $("#departamento_ver").text(departamento_ver);
}
</script>
<script>
$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});
</script>
@endsection
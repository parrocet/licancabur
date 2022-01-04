@extends('layouts.appLayout')
<head>
    <style type="text/css">
        .callout{border-radius:3px;margin:0 0 20px 0;padding:15px 30px 15px 15px;border-left:5px solid #eee}.callout a{color:#fff;text-decoration:underline}.callout a:hover{color:#eee}.callout h4{margin-top:0;font-weight:600}.callout p:last-child{margin-bottom:0}.callout code,.callout .highlight{background-color:#fff}.callout.callout-danger{border-color:#c23321}.callout.callout-warning{border-color:#c87f0a}.callout.callout-info{border-color:#0097bc}.callout.callout-success{border-color:#00733e}

        .callout.callout-danger,.callout.callout-warning,.callout.callout-info,.callout.callout-success,.alert-success,.alert-danger,.alert-error,.alert-warning,.alert-info,.label-danger,.label-info,.label-warning,.label-primary,.label-success,.modal-primary .modal-body,.modal-primary .modal-header,.modal-primary .modal-footer,.modal-warning .modal-body,.modal-warning .modal-header,.modal-warning .modal-footer,.modal-info .modal-body,.modal-info .modal-header,.modal-info .modal-footer,.modal-success .modal-body,.modal-success .modal-header,.modal-success .modal-footer,.modal-danger .modal-body,.modal-danger .modal-header,.modal-danger .modal-footer{color:#fff !important}.bg-gray{color:#000;background-color:#d2d6de !important}.bg-gray-light{background-color:#f7f7f7}.bg-black{background-color:#111 !important}.bg-red,.callout.callout-danger,.alert-danger,.alert-error,.label-danger,.modal-danger .modal-body{background-color:#dd4b39 !important}.bg-yellow,.callout.callout-warning,.alert-warning,.label-warning,.modal-warning .modal-body{background-color:#f39c12 !important}.bg-aqua,.callout.callout-info,.alert-info,.label-info,.modal-info .modal-body{background-color:#00c0ef !important}.bg-blue{background-color:#0073b7 !important}.bg-light-blue,.label-primary,.modal-primary .modal-body{background-color:#3c8dbc !important}.bg-green,.callout.callout-success,.alert-success,.label-success,.modal-success .modal-body{background-color:#00a65a !important}
    </style>
</head>

@section('breadcomb')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-4">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Eliminación de Actividades</h2>
                                    <p>Buscar actividades de la planificación de la semana para eliminar</p>
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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="breadcomb-report">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
@endsection

@section('content')
<!-- Form Element area Start-->
<div class="form-element-area modals-single">
    <div class="container" style="width: ;">
        <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-danger" style="height: -5px;">
                    <h4>Recordatorio!</h4>
                    Hay dos tipos de eliminación:<br>
                    <ul>
                        <li><strong>Eliminación global</strong> 
                            <ul>
                                <li>Elimina todas las actividades en la planificación, área y el tipo seleccionado</li>
                            </ul>
                        </li>
                        <li><strong>Eliminación específica</strong> 
                            <ul>
                                <li>Elimina las actividades seleccionadas en la tabla</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                   <!-- {!! Form::open(['route' => ['actividades.buscar_actividades_semana_actual'],'method' => 'post']) !!} -->
                 <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        
                        <h3><strong style="align-content: center;">Eliminar actividades de forma global</strong></h3>                
                        @include('flash::message')
                    </div>
                        @csrf
                    <hr> 
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label for="gerencias"><b style="color: red;">*</b> Planificaciones:</label>
                                    <select class="form-control" name="id_gerencia_search" id="id_gerencia_search" onchange="BuscarAreas(this.value)">
                                        <option value="0">Seleccione una planificación</option>
                                        @foreach($planificaciones as $item)
                                            <option value="{{$item->id}}">Semana: {{$item->semana}} | {{$item->fechas}} - {{$item->gerencia}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_planificacion" id="id_planificacion">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label><b style="color: red;">*</b> Areas:</label>
                                    <select disabled="" placeholder="Seleccione un área"  name="id_area_search" id="id_area_search" class="form-control" onchange="buscarTipo(this.value)">
                                        <option value="" disabled="">Seleccione un área</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label for="tipo_actividad"><b style="color: red;">*</b> Tipo:</label>
                                    <select name="tipo_actividad" id="tipo_actividad" placeholder="Seleccione un tipo" disabled="" class="form-control" onchange="BuscarActividades(this.value)">
                                        <option value="0">Seleccione un Tipo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                        
                    <div id="Cargando" style="display: none;">
                        <center>
                            <div id="mensaje2"></div>
                            <img src="{{ asset('assets/img/tenor2.gif') }}" alt="Logo" height="40px" width="100px;" title="Cargando" />
                        </center>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <button style="width: 100%" disabled="" class="btn btn-md btn-danger" id="buscar_actividades" value="0" data-toggle="modal" data-target="#ModalGlobal" data-backdrop="static" data-keyboard="false">Eliminación global</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

{!! Form::open(['route' => ['eliminar_actividades_multiple'],'method' => 'post']) !!}
    <div class="form-element-area modals-single">
        <div class="container">
            <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd text-center">
                            <h3><strong style="align-content: center;">Eliminar actividades de forma Específica</strong></h3>
                        </div>
                       <!-- {!! Form::open(['route' => ['actividades.buscar_actividades_semana_actual'],'method' => 'post']) !!} -->

                            @csrf 
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                <div class="form-group ic-cmpint">
                                    <div class="nk-int-st">
                                        <hr>
                                        <div class="basic-tb-hd text-center">
                                            <a style="width: 100%;" s href="#" disabled="" class="btn btn-md btn-success" id="buscar_actividades2" value="0" data-toggle="modal" data-target="#ModalGlobal2" data-backdrop="static" data-keyboard="false">Eliminación específica</a>
                                            <hr>
                                            <div id="mensaje_activi"></div>
                                            <table id="tabla_muestra" class="table table-striped">
                                               
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('planificacion.modales.eliminar_actividades_global2')

        <input type="hidden" name="global" id="global" value="0">
        <input type="hidden" name="id_gerencia_search" id="id_planifi">
        <input type="hidden" name="id_area_search" id="id_area">
        <input type="hidden" name="tipo_actividad" id="id_empleado">
        <input type="hidden" name="contraseña" id="contraseña_confir2-2" required>

    {!! Form::close() !!}
    {!! Form::open(['route' => ['eliminar_actividades_multiple'],'method' => 'post']) !!}
    
        @include('planificacion.modales.eliminar_actividades_global')

        <input type="hidden" name="global" id="global" value="1">
        <input type="hidden" name="id_gerencia_search" id="id_planifi2">
        <input type="hidden" name="id_area_search" id="id_area2">
        <input type="hidden" name="tipo_actividad" id="id_empleado2">
        <input type="hidden" name="contraseña" id="contraseña_confir2" required>

    {!! Form::close() !!}


<div class="modal fade" id="ModalMensaje" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Registro eliminado con éxito!</h2>

            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

    function VerificaContraseña(opcion, clave) {
        // var id_usuario = $('#id_usuario').val();
        $('.contraseña_incorrecta').empty();
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });

        // alert(clave+" - "+id_usuario);
        $.ajax({
            type: "post",
            url: "validar_clave",
            data: {
                clave:clave,
                // id_usuario:id_usuario,
            }, success: function (data) {
                // console.log(data);
                // si data==1 entonces la clave es correcta
                // si data==0 entonces la clave es incorrecta
                if(data==1){
                    if (opcion == 1) {
                        if ($('#contraseña_confir2').val()) {
                            $('#contraseña_confir2').val(clave);
                            $('#botonEliminarG').removeAttr('disabled',false);
                        }else{
                            $('#botonEliminarG').attr('disabled',true);
                        }
                    }else{
                        if ($('#contraseña_confir2-2').val()) {
                            $('#contraseña_confir2-2').val(clave);
                            $('#botonEliminarE').removeAttr('disabled',false);
                        }else{
                            $('#botonEliminarE').attr('disabled',true);
                        }
                    }
                }else{
                    //muestra el campo de la clave con borde rojo
                    $('.contraseña_incorrecta').addClass('text-danger').append('<strong>La contraseña no coincide con el usuario</strong>');
                }
            }
        }); 
    }
    function BuscarAreas(id_planificacion){

        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>cargando áreas. Por favor, espere...</strong></h3>');
        // var id_planificacion=event.target.value;
        $('#tabla_muestra').empty()
        id_gerencia=$('#id_gerencia_search').val();
        $('#id_planifi').val(id_gerencia);
        $('#id_planifi2').val(id_gerencia);

        $.get("/asignaciones/"+id_planificacion+"/buscar",function (data) {
        })
        .done(function(data) {
            $('#mensaje2').empty();
            $('#Cargando').css('display','none');
            $('#mensaje_activi').empty();
            $("#id_area_search").empty();
            $("#id_area_search").append('<option value="">Seleccione un área</option>');
            if(data.length > 0){
                $("#id_area_search").attr('disabled',false);
                for (var i = 0; i < data.length ; i++) 
                {  
                    $("#id_area_search").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }
            }else{
                // $('#tabla_muestra').append('<center><h3><strong>No hay áreas para la planificación seleccionada!</strong></h3></center>');
                $("#id_area_search").attr('disabled', true);

            }
        });
    }


    function buscarTipo(id_area) {
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>Cargando los tipos de actividades. Por favor, espere...</strong></h3>');
        $('#tabla_muestra').empty();
        $('#tipo_actividad').empty();
        $('#tipo_actividad').append('<option value="0">Seleccione un Tipo</option>');

        $.get("/actividades/"+id_area+"/buscar_tipo",function (data) {
        })
        .done(function(data) {
                $('#mensaje2').empty();
                $('#Cargando').css('display','none');
            if(data.length > 0){
                $('#tipo_actividad').removeAttr('disabled',false);
                // $("#buscar_actividades2").removeAttr('disabled', false);
                for (var i = 0; i < data.length ; i++) 
                { 
                    // $("#buscar_actividades").removeAttr('disabled'); 
                    // $("#tipo_actividad").removeAttr('disabled');
                    $("#tipo_actividad").append('<option value="'+ data[i].tipo + '">' + data[i].tipo +'</option>');
                }
            }else{
                $('#tabla_muestra').append('<center><h3><strong>No hay tipos de actividades con la planificacion y areas seleccionados!</strong></h3></center>');
                $("#tipo_actividad").attr('disabled',true);
                $("#buscar_actividades").attr('disabled');
                $('#buscar_actividades2').attr('disabled');
            }

        });
    }

    function BuscarActividades(tipo) {
        
        var id_area = $('#id_area_search').val();
        var id_planificacion= $("#id_gerencia_search").val();
        $('#id_area').val(id_area);
        $('#id_area2').val(id_area);
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>Cargando Actividades. Por favor, espere...</strong></h3>');

        // alert(id_area + ' - ' +tipo);
        // var id_area=event.target.value;
        // alert(id_planificacion+' '+id_area);
        // $("#tipo_actividad").empty();
        // $("#tipo_actividad").append('<option value="">Seleccione un tipo de actividad</option>');
        
        



        $.get("/actividades/"+id_area+"/"+id_planificacion+"/"+tipo+"/buscar",function (data) {
            
            
           

        })
        .done(function(data) {
            $('#Cargando').css('display','none');
            $('#mensaje2').empty();
            $('#mensaje_activi').empty();
            $('#tabla_muestra').empty()
            $("#mensaje_activi").empty();
            // alert('asdasd');

            $('#data-table-basic').empty();

            if(data.length > 0){
                //console.log('trae');
                $('#buscar_tipo').removeAttr('disabled',false);
                $("#mensaje_activi").append('Hay '+data.length+' actividades que serán asignadas al empleado seleccionado<hr>');
                $("#tabla_muestra").append('<thead><tr><th>Selección</th><th>#</th><th>Actividad</th><th>Tipo</th><th>Duración</th><th>Fecha de vencimiento</th></tr></thead>');

                for (var i = 0; i < data.length ; i++) 
                {
                    var duracion;
                    if(data[i].duracion_pro != null){
                        duracion=data[i].duracion_pro;
                    }else{
                        duracion='Sin duración';
                    }
                    v=i+1;
                    $("#tabla_muestra").append('<tbody><tr><td><input type="checkbox" name="id_actividad[]" id="id_actividad_espe[]" value="'+data[i].id+'"></td><td>'+v+'</td><td>'+ data[i].task +'</td><td>'+ data[i].tipo +'</td><td>'+ duracion +'</td><td>'+ data[i].fecha_vencimiento +'</td></tr></tbody');
                    // $("#buscar_actividades").removeAttr('disabled');
                    $('#buscar_actividades2').removeAttr('disabled'); 
                    // $("#mensaje_activi").removeAttr('disabled');
                    // $("#tipo_actividad").append('<option value="'+ data[i].id + '">' + data[i].nombres +' '+ data[i].apellidos +' - '+ data[i].rut +'</option>');
                }
            }else{
                //console.log('No trae');
                // $('#tabla').hide();
                $('#buscar_tipo').attr('disabled', true);
                $('#data-table-basic').append('No se encuentran actividades con la planificacion y areas seleccionados!');
                $("#buscar_actividades").attr('disabled',true);
                $('#buscar_actividades2').attr('disabled',true);
                $("#mensaje_activi").append('No se encuentran actividades con la planificacion y areas seleccionados!');
                // $("#mensaje_activi").append('No se encuentran actividades con la planificacion y areas seleccionados!');
            }
        });
    }
$(document).ready( function(){

    //------ realizando busqueda de las actividades deacuerdo al filtro
        //select dinámico


    // $("#id_area_search").on("change",function (event) {

    //     area        =$('#id_area_search').val();
    //     $('#id_area').val(area);


    //     var id_planificacion= $("#id_gerencia_search").val();
    //     var id_area=event.target.value;
    //     // alert(id_planificacion+' '+id_area);
    //     $("#tipo_actividad").empty();
    //     $("#tipo_actividad").append('<option value="">Seleccione un tipo de actividad</option>');
        
    //     $.get("/actividades/"+id_area+"/buscar_tipo",function (data) {
            
    //         beforeSend: $("#mensaje_activi").append('Cargando...');
    //         complete: $("#mensaje_activi").empty();
    //         // $("#tipo_actividad").empty();
        
    //         if(data.length > 0){

    //             $('#tipo_actividad').removeAttr('disabled',false);
    //             $("#buscar_actividades2").removeAttr('disabled', false);
                

    //             for (var i = 0; i < data.length ; i++) 
    //             { 
    //                 // $("#buscar_actividades").removeAttr('disabled'); 
    //                 // $("#tipo_actividad").removeAttr('disabled');
    //                 $("#tipo_actividad").append('<option value="'+ data[i].tipo + '">' + data[i].tipo +'</option>');
    //             }

    //         }else{
    //             $("#tipo_actividad").attr('disabled',true);
    //             $("#buscar_actividades").attr('disabled');
    //             $('#buscar_actividades2').attr('disabled');

    //         }

    //     });


    //     $.get("/actividades/"+id_area+"/"+id_planificacion+"/buscar",function (data) {
            
            
    //         // $("#actividades_muestra").empty();
    //         $('#tabla_muestra').empty()
    //         $("#mensaje_activi").empty();
    //         // alert('asdasd');

    //         $('#data-table-basic').empty();

    //         if(data.length > 0){
    //             console.log('trae');
    //             $('#buscar_tipo').removeAttr('disabled',false);
    //             $("#mensaje_activi").append('Hay '+data.length+' actividades que serán asignadas al empleado seleccionado<hr>');
    //             $("#tabla_muestra").append('<thead><tr><th>Selección</th><th>#</th><th>Actividad</th><th>Tipo</th><th>Duración</th><th>Fecha de vencimiento</th></tr></thead>');

    //             for (var i = 0; i < data.length ; i++) 
    //             {
    //                 v=i+1;
    //                 $("#tabla_muestra").append('<tbody><tr><td><input type="checkbox" name="id_actividad[]" id="id_actividad_espe[]" value="'+data[i].id+'"></td><td>'+v+'</td><td>'+ data[i].task +'</td><td>'+ data[i].tipo +'</td><td>'+ data[i].duracion_pro +'</td><td>'+ data[i].fecha_vencimiento +'</td></tr></tbody');
    //                 // $("#buscar_actividades").removeAttr('disabled');
    //                 $('#buscar_actividades2').removeAttr('disabled'); 
    //                 // $("#mensaje_activi").removeAttr('disabled');
    //                 // $("#tipo_actividad").append('<option value="'+ data[i].id + '">' + data[i].nombres +' '+ data[i].apellidos +' - '+ data[i].rut +'</option>');
    //             }

    //         }else{
    //             console.log('No trae');
    //             // $('#tabla').hide();
    //             $('#buscar_tipo').attr('disabled', true);
    //             $('#data-table-basic').append('No se encuentran actividades con la planificacion y areas seleccionados!');
    //             $("#buscar_actividades").attr('disabled',true);
    //             $('#buscar_actividades2').attr('disabled',true);
    //             $("#mensaje_activi").append('No se encuentran actividades con la planificacion y areas seleccionados!');
    //             // $("#mensaje_activi").append('No se encuentran actividades con la planificacion y areas seleccionados!');

    //         }

    //     });


    // });

    $("#tipo_actividad").on("change",function (event) {

        // $('#tabla').show();

        $("#buscar_actividades").removeAttr('disabled',false);
        // $("#tabla_muestra").empty();
        var empleado=$('#tipo_actividad').val();
        $('#id_empleado').val(empleado);
        $('#id_empleado2').val(empleado);
        // $('#tabla').hide();

    });

});
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
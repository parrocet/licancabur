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
                                    <h2>Asignación de Actividades</h2>
                                    <p>Asignar actividades de la planificación por semana</p>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-success" style="height: -5px;">
                    <h4>Recordatorio!</h4>
                    Hay dos tipos de asignación:<br>
                    <ul>
                        <li><strong>Asignación global</strong> 
                            <ul>
                                <li>Asigna todas las actividades en la planificación y área, al empleado seleccionado</li>
                            </ul>
                        </li>
                        <li><strong>Asignación específica</strong> 
                            <ul>
                                <li>Asigna las actividades seleccionadas en la tabla, de la planificación y área al empleado seleccionado</li>
                            </ul>
                        </li>
                    </ul>
                    
                    
                </div>
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        
                        <h3><strong style="align-content: center;">Asignar actividades de forma global</strong></h3>                
                        @include('flash::message')
                        <hr>
                    </div>
                   <!-- {!! Form::open(['route' => ['actividades.buscar_actividades_semana_actual'],'method' => 'post']) !!} -->
                    {!! Form::open(['route' => ['asignacion_multiple'],'method' => 'post']) !!}

                        @csrf 
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label for="gerencias"><b style="color: red;">*</b> Planificaciones:</label>
                                    <select class="form-control" name="id_gerencia_search" id="id_gerencia_search">
                                        <option value="0" disabled selected>Seleccione una planificación</option>
                                        @foreach($planificaciones as $item)
                                            <option value="{{$item->id}}">Semana: {{$item->semana}} | {{$item->fechas}} | {{$item->gerencias->gerencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_planificacion" id="id_planificacion">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label for="id_area_search"><b style="color: red;">*</b> Areas:</label>
                                    <select placeholder="Seleccione un área" disabled name="id_area_search" id="id_area_search" class="form-control">
                                        <option value="" disabled="">Seleccione un área</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                            <div class="form-group ic-cmpint">
                                <div class="nk-int-st">
                                    <label for="id_empleados_search"><b style="color: red;">*</b> Empleados:</label>
                                    <select name="id_empleados_search" disabled placeholder="Seleccione empleado" id="id_empleados_search" class="form-control is-valid">
                                        <option value="" disabled="">Seleccione un empleado</option>
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
                    <div class="form-group ic-cmpint">
                        <div class="nk-int-st">
                            <div class="row">
                                <div class="col-md-6">
                                    <button style="width: 100%;" disabled="" class="btn btn-md btn-default" id="buscar_actividades">Asignación global</button>
                                </div>
                                <div class="col-md-6">
                                    <input style="width: 100%;" disabled type="button"  class="btn btn-md btn-danger" id="eliminar_asignaciones" value="Eliminar Asignación global" onclick="eliminar_g()" />
                                    <span id="mensaje_error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="global" id="global" value="1">
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>

{!! Form::open(['route' => ['asignacion_multiple'],'method' => 'post']) !!}
    <div class="form-element-area modals-single">
        <div class="container" style="width: ;">
            <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd text-center">
                            <h3><strong style="align-content: center;">Asignar actividades de forma Específica</strong></h3>
                        </div>
                       <!-- {!! Form::open(['route' => ['actividades.buscar_actividades_semana_actual'],'method' => 'post']) !!} -->
                        <hr>
                            @csrf 
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                <div class="form-group ic-cmpint">
                                    <div class="nk-int-st">
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-6">
                                                <div><button style="width: 100%;" disabled="" class="btn btn-md btn-success" id="buscar_actividades2">Asignación Específica</button> </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-6">
                                                <input style="width: 100%;" disabled type="button" data-target="#myModaltre" data-toggle="modal" class="btn btn-md btn-danger" name="eliminar_especifica" id="eliminar_especifica" value="Eliminar Asignaciones Específicas">
                                            </div>
                                        </div>
                                        <span id="mensaje_error2" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" name="global" id="global" value="0">
                        <input type="hidden" name="id_empleados_search" id="id_empleado">
                        <input type="hidden" name="id_area_search" id="id_area">

                        <div id="tabla_muestra">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@include('planificacion.modales.eliminar_asignacion')
@include('planificacion.modales.eliminar_asignacion_g')
@endsection

@section('scripts')
<script>
	function eliminar_g() {
    	//console.log("entro");

    	var id_planificacion=   $('#id_gerencia_search').val();
        var id_empleado=    $('#id_empleados_search').val();
        var id_area =     $('#id_area_search').val();
        if (id_planificacion==0 || id_empleado=="" || id_area=="") {
        	$("#mensaje_error").text("Algunos elementos no han sido seleccionados");
        }else{
        $("#id_planificacion_g").val(id_planificacion);
        $("#id_empleado_g").val(id_empleado);
        $("#id_area_g").val(id_area);
        $("#myModaltre2").modal();
        $("#mensaje_error").text("");
        $("#mensaje_error2").text("");

    	}
    }
    function eliminar_asignaciones_g() {
    	var id_planificacion=   $('#id_planificacion_g').val();
        var id_empleado=    $('#id_empleado_g').val();
        var id_area =     $('#id_area_g').val();
        var contenido =     $('#contenido').val();
        //console.log(id_planificacion+"-"+id_empleado+""+id_area);
        $.get('asignaciones_g/'+id_planificacion+'/'+id_empleado+'/'+id_area+'/eliminar_asignacion_g',function(data){
                    //console.log(data.length);
                $("#"+contenido).empty();
                $('#myModaltre2').modal('hide');
                $('#ModalMensaje').modal();
                $(location).attr('href', '{{url('asignaciones')}}');
        });
    }
    
    function eliminar() {

        $('#myModaltre').modal('hide');
        var id_empleado=$('#id_empleados_search').val();
        console.log("id_empleado="+id_empleado);
        if (id_empleado!=="") {
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });


        //Recorrer tabla
        var tabla = $("#tabla_muestra2").find("tr");
        var resultado = "";
        //Recorre filas
        var selected = [];

        for(i=1; i<tabla.length; i++){
            var td = $(tabla[i]).find("td");
            input= $(td.children("input")[0]).val();
            if($('#id_actividad'+input).prop('checked')){
                selected.push(input);
            }
        }

        // alert(selected[1]);
    	// $(":checkbox[name=id_actividad]").each(function() {
     //  	if (this.checked) {
     //            // agregas cada elemento.
     //        selected.push($(this).val());
     //  	}
    	// });
    	if (selected.length) {

          	$.ajax({
            cache: false,
            type: 'post',
            dataType: 'json', // importante para que 
            data: {selected:selected,id_empleado:id_empleado}, // jQuery convierta el array a JSON
            url: 'asignaciones/eliminar',
            success: function(data) {
        		if(data > 0){
        			$('#ModalMensaje').modal();
        			$("#mensaje_error2").text("");
                    $(location).attr('href', '{{url('asignaciones')}}');
        		}else{
        			$("#mensaje_error2").text("No se pudo realizar la eliminación de la asignación de forma específica");
        		}
            }
          });

          // esto es solo para demostrar el json,
          // con fines didacticos
          //alert(JSON.stringify(selected));

	    } else{
	    	$("#mensaje_error2").text("Debe seleccionar al menos una actividad para realizar la operación");  
	    	
	    }
	}else{
		$("#mensaje_error2").text("No seleccionó el empleado para eliminarle las actividades asignadas");
	}
    }

</script>
<script>
$(document).ready( function(){
    var respuesta=0;

    //------ realizando busqueda de las actividades deacuerdo al filtro
        //select dinámico
    $("#id_gerencia_search").on("change",function (event) {

        $('#tabla_muestra').empty();
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>cargando áreas. Por favor, espere...</strong></h3>');
        var id_planificacion=event.target.value;
        $.get("/asignaciones/"+id_planificacion+"/buscar",function (data) {
            

        })
        .done(function(data) {
            $('#mensaje2').empty();
            $('#Cargando').css('display','none');
            $("#id_area_search").empty();
            $("#id_area_search").append('<option value="">Seleccione un área</option>');
        
            if(data.length > 0){

                $('#id_area_search').attr('disabled',false);
                for (var i = 0; i < data.length ; i++) 
                {  
                        
                    
                    $("#id_area_search").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }

            }else{
                $("#id_area_search").attr('disabled', true);

            }
        });
    });

    $("#id_area_search").on("change",function (event) {

        $('#tabla_muestra').empty();
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>Cargando empleados. Por favor, espere...</strong></h3>');
        area        =$('#id_area_search').val();
        $('#id_area').val(area);


        var id_planificacion= $("#id_gerencia_search").val();
        var id_area=event.target.value;
        // alert(id_planificacion+' '+id_area);
        $("#id_empleados_search").empty();
        $("#id_empleados_search").append('<option value="">Seleccione un empleado</option>');
        // alert(id_area);
        $.get("/empleados/"+id_area+"/buscar",function (data) {
        }).done(function(data) {
            $('#mensaje2').empty();
            $('#Cargando').css('display','none');
            // $("#id_empleados_search").empty();
        
            if(data.length > 0){

                $("#id_empleados_search").attr('disabled',false);
                for (var i = 0; i < data.length ; i++) 
                { 
                    // $("#buscar_actividades").removeAttr('disabled'); 
                    // $("#id_empleados_search").removeAttr('disabled');
                    $("#id_empleados_search").append('<option value="'+ data[i].id + '">' + data[i].nombres +' '+ data[i].apellidos +' - '+ data[i].rut +'</option>');
                }

            }else{
                $("#id_empleados_search").attr('disabled',true);
                $('#tabla_muestra').append('<center><h3><strong>No hay empleados registrados en esta área!</strong></h3></center>');
                $("#id_empleados_search").attr('disabled');
                $("#buscar_actividades").attr('disabled');
                $('#buscar_actividades2').attr('disabled');

            }


        }).error(function(data) {
            $('#mensaje2').empty();
            $('#Cargando').css('display','none');
            $("#id_empleados_search").attr('disabled',true);
            $('#tabla_muestra').append('<center><h3><strong>Ha ocurrido un error! Inténtelo de nuevo mas tarde!</strong></h3></center>');
            $("#id_empleados_search").attr('disabled');
            $("#buscar_actividades").attr('disabled');
            $('#buscar_actividades2').attr('disabled');
        });
    });

    $("#id_empleados_search").on("change",function (event) {

        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>Cargando Actividades. Por favor, espere...</strong></h3>');
        var id_area=$('#id_area_search').val();
        var id_planificacion = $('#id_gerencia_search').val();
        $('#tabla_muestra').empty();
        var id_empleado=$('#id_empleados_search').val();
        $('#id_empleado').val(id_empleado);

        $.get("/actividades/"+id_area+"/"+id_planificacion+"/buscar",function (data) {

            // $.get("/actividades/"+id_area+"/"+id_planificacion+"/buscar2",function (data2) {
                $('#mensaje2').empty();
                $('#Cargando').css('display','none');
                $("#actividades_muestra").empty();            
                $('#data-table-basic').empty();
                if(data.length > 0){
                    // alert('TRAE');
                    $("#tabla_muestra").append('<table id="tabla_muestra2" class="table table-striped"><thead><tr><th>Selección</th><th>#</th><th>Asignada</th><th>Actividad</th><th>Día</th><th>Tipo</th><th>Duración</th><th>Cant. Pers.</th><th>Fecha de vencimiento</th></tr></thead>');
                    var id_actividad;
                    
                    for (var i = 0; i < data.length ; i++) 
                    {
                        v=i+1;
                        asignadas(data[i].id,id_empleado);

                        if (data[i].duracion_pro == null) {
                            var duracion_pro = 'Sin datos';
                        } else {
                            var duracion_pro = data[i].duracion_pro;
                        }

                        $("#tabla_muestra2").append('<tbody><tr><td><input type="checkbox" name="id_actividad[]" id="id_actividad'+data[i].id+'" value="'+data[i].id+'"></td><td>'+v+'</td><td aligne="center"><div id="estado'+data[i].id+'"></div></td><td>'+ data[i].task +'</td><td>'+data[i].dia+'</td><td>'+ data[i].tipo +'</td><td>'+ duracion_pro +'</td><td>'+data[i].cant_personas+'</td><td>'+ data[i].fecha_vencimiento +'</td></tr></tbody');
                        $("#buscar_actividades").removeAttr('disabled');
                        $('#eliminar_asignaciones').removeAttr('disabled');
                        $('#buscar_actividades2').removeAttr('disabled');
                        $('#eliminar_especifica').removeAttr('disabled'); 
                        // $("#id_empleados_search").append('<option value="'+ data[i].id + '">' + data[i].nombres +' '+ data[i].apellidos +' - '+ data[i].rut +'</option>');
                    }
                    $("#tabla_muestra").append('</table>');
                }else{
                    // $('#tabla').hide();
                    // alert('NO TRAE');
                    $('#tabla_muestra').append('<center><h3><strong>No hay actividades registrados en esta área y planificación!</strong></h3></center>');
                    $("#buscar_actividades").attr('disabled',true);
                    $('#eliminar_asignaciones').attr('disabled');
                    $('#buscar_actividades2').attr('disabled',true);
                    $('#eliminar_especifica').attr('disabled'); 

                }
            // });
        });
    });
    //         .done(function(data) {
    //         });

    //     $.get("/actividades/"+id_area+"/"+id_planificacion+"/buscar2",function (data) {
            

    //     })
    //     .done(function(data) {

    //         if(data.length > 0){

    //             $("#tabla_muestra").append('<thead><tr><th>Selección</th><th>#</th><th>Asignada</th><th>Actividad</th><th>Día</th><th>Tipo</th><th>Duración</th><th>Cant. Pers.</th><th>Fecha de vencimiento</th></tr></thead>');
    //             var id_actividad;
                
    //             for (var i = 0; i < data.length ; i++) 
    //             {
    //                 v=i+1;
    //                 asignadas(data[i].id);

    //                 $("#tabla_muestra").append('<tbody><tr><td><input type="checkbox" name="id_actividad[]" id="id_actividad" value="'+data[i].id+'"></td><td>'+v+'</td><td aligne="center"><span id="estado'+data[i].id+'"></span></td><td>'+ data[i].task +'</td><td>'+data[i].dia+'</td><td>'+ data[i].tipo +'</td><td>'+ data[i].duracion_pro +'</td><td>'+data[i].cant_personas+'</td><td>'+ data[i].fecha_vencimiento +'</td></tr></tbody');
    //                 $("#buscar_actividades").removeAttr('disabled');
    //                 $('#buscar_actividades2').removeAttr('disabled'); 
    //                 // $("#id_empleados_search").append('<option value="'+ data[i].id + '">' + data[i].nombres +' '+ data[i].apellidos +' - '+ data[i].rut +'</option>');
    //             }

    //         }else{
    //             $('#data-table-basic').append('No se encuentran actividades con la planificacion y areas seleccionados!');
    //             $("#buscar_actividades").attr('disabled',true);
    //             $('#buscar_actividades2').attr('disabled',true);

    //         }
    //     });
    });


function asignadas(id_actividad,id_empleado){
    $.get('/actividades/'+id_actividad+'/asignada',function (data){
        // var j=id_actividad;
        // var estado="#estado";
        // var est="";
        // var js="";
        // js=j.toString();
        // est=estado.concat(js);
        if(data.length > 0){
            for (var i = 0; i < data.length ; i++) {

                if (data[i].id == id_empleado) {
                    // $('#id_actividad'+id_actividad).hide();
                    $('#estado'+id_actividad).append(
                        '<div class="material-design-btn">'+
                            '<div class="row" width="100%">'+
                                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">'+
                                    '<button style="color:white;" disabled class="btn notika-btn-cyan waves-effect"><strong>'+data[i].nombres+' '+data[i].apellidos+' - '+data[i].rut+'</strong>'+
                                    '</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $('#estado'+id_actividad).append(
                        '<div class="material-design-btn">'+
                            '<div class="row" width="100%">'+
                                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">'+
                                    '<button style="color:white;" disabled class="btn notika-btn-amber waves-effect"><strong>'+data[i].nombres+' '+data[i].apellidos+' - '+data[i].rut+'</strong>'+
                                    '</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
            }
        }else{
            $('#estado'+id_actividad).append(
                '<div class="material-design-btn">'+
                    '<div class="row" width="100%">'+
                        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">'+
                            '<button style="color:white;" disabled class="btn notika-btn-green waves-effect"><strong>Sin asignaciones</strong>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            );
        }

    });
    
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
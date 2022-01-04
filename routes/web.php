<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/recuperar_clave',function(){
	return view('auth/passwords/reset');
});
Route::get('/inicio', function () {
    return view('auth/inicio');
});
Route::post('recuperando_clave','Auth\ResetPasswordController@recuperando_clave')->name('recuperando_clave');
Auth::routes(["verify" => true]);

Route::group(['middleware' => ['web', 'auth']], function() { 
/* Para verificar que el usuario que accede está verificado se le añade 
    a la ruta el middleware "verified" */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home_buscar', 'HomeController@buscar')->name('home.buscar');
Route::get('/estadisticas', 'HomeController@dashboardStadistic')->name('estadisticas');
Route::post('/actualizar_anio', 'HomeController@actualizar_anio')->name('actualizar_anio');

Route::get('getData', 'PlanificacionController@getData');
Route::get('/planificacion', 'PlanificacionController@create')->name('planificacion.create');
//Route::get('view', 'PlanificacionController@view')->name('view');
Route::resource('planificacion','PlanificacionController');
Route::resource('asignaciones','AsignacionesController');
Route::get('asignacion/{id_empleado}/buscar','AsignacionesController@buscar_empleado');
Route::get('permisos/{id_empleado}/buscar','PrivilegiosController@buscar_privilegios');
Route::get('permisos/{id_privilegio}/{opcion}/{id_usuario}/actualizando','PrivilegiosController@actualizando');
Route::get('asignacion2/{activi}/buscar','AsignacionesController@buscar_empleado2');



Route::get('planificacion/{id_gerencia}/buscar','PlanificacionController@buscar_areas');
Route::get('planificacion/{num_semana}/calcular_fechas','PlanificacionController@calcular_fechas');
Route::post('planificacion/buscar','PlanificacionController@buscar')->name('planificacion.buscar');
Route::resource('empleados','EmpleadosController');
Route::post('empleados/cambiar_status','EmpleadosController@cambiar_status')->name('empleados.cambiar_status');
Route::post('empleados/eliminar','EmpleadosController@destroy')->name('empleados.eliminar');
Route::resource('usuarios','UsuariosController',['except' => ['update']]);
Route::post('usuarios/update/{id}','UsuariosController@update')->name('usuarios.update');
Route::post('usuarios/update_privilegios/{id}','UsuariosController@update_privilegios')->name('usuarios.update_privilegios');
Route::resource('actividades','ActividadesController');
Route::get('actividades/buscar','ActividadesController@buscar')->name('actividades.buscar');
Route::get('actividades/{id_actividad}/mis_archivos','ActividadesController@mis_archivos');
Route::get('actividades/{id_actividad}/mis_imagenes','ActividadesController@mis_imagenes');
Route::get('actividades/{id_actividad}/eliminar_archivos','ActividadesController@eliminar_archivos');
Route::get('empleados/{id_area}/buscar','ActividadesController@buscar_empleados');
Route::post('actividades/asignar','ActividadesController@asignar_actividad')->name('actividades.asignar');

Route::get('actividades/{id_actividad}/comentarios','ActividadesController@buscar_comentarios');
Route::get('actividades/{id_actividad}/mis_comentarios','ActividadesController@comentarios_actividad');
Route::post('actividades/registrar_comentario','ActividadesController@registrar_comentario');
Route::get('actividades/{id_actv_proceso}/{id_comentario}/eliminar_comentario','ActividadesController@eliminar_comentario');
Route::get('actividades/{id_actividad}/buscar_archivos','ActividadesController@buscar_archivos');
Route::get('actividades/{id_actividad}/buscar_imagenes','ActividadesController@buscar_imagenes');
Route::post('actividades/registrar_archivos','ActividadesController@registrar_archivos');
Route::post('actividades/registrar_imagenes','ActividadesController@registrar_imagenes');
Route::get('actividades_proceso/{id_actividad}/buscar_archivos_adjuntos','ActividadesController@buscar_archivos_adjuntos');
Route::get('actividades_proceso/{id_actividad}/buscar_imagenes_adjuntas','ActividadesController@buscar_imagenes_adjuntas');
Route::get('actividades_proceso/{id_actividad}/eliminar_archivos_adjuntos','ActividadesController@eliminar_archivos_adjuntos');
Route::get('actividades/{id_actividad}/vistas','ActividadesController@actividad_vista');
Route::get('actividades/{id_comentario}/vistos','ActividadesController@comentario_visto');
Route::get('actividades_proceso/finalizar','ActividadesController@finalizar')->name('finalizar_actividad');
Route::get('graficas/status_general','GraficasController@status_general')->name('graficas.status_general');
Route::resource('graficas','GraficasController');

/*Route::post('excel/actividades','ReportesExcelController@store')->name('excel.actividades');*/
/*Route::post('pdf/actividades','ReportesPDFController@actividades')->name('pdf.actividades');*/
Route::post('/bladeToExcel','ExcelController@bladeToExcel')->name('bladeToExcel');
Route::get('users/export/', 'ExcelController@actividades');
Route::get('users_view', 'ExcelController@users_view');
Route::get('act/excel', 'ExcelController@act_excel');
//REPORTES -- EXCEL Y PDF ------/////
Route::resource('reportes','ReportesController');

Route::get('api_fc','PlanificacionController@api_fc'); //ruta que nos devuelve los eventos en formato json
Route::get('api_buscar','PlanificacionController@api_buscar')->name('api_buscar');

Route::resource('gerencias','GerenciasController');
Route::resource('areas','AreasController');
Route::resource('departamentos','DepartamentosController');
Route::resource('privilegios','PrivilegiosController');

Route::get('actividades/{id_departamento}/buscar_departamentos','ActividadesController@buscar_departamentos');
Route::get('actividad/buscar_actividades_semana_actual','ActividadesController@buscar_actividades_semana_actual')->name('actividades.buscar_actividades_semana_actual');
Route::get('actividades/{id_actividad}/mover_admin','ActividadesController@moviendo_actividad_admin');
Route::post('actividades/asignar_otra','ActividadesController@asignar_otra_actividad')->name('actividades.asignar_otra');
Route::get('actividades/{id_empleado}/sin_realizar','ActividadesController@actividades_sin_realizar');
Route::post('actividades/mover_a_empleado','ActividadesController@mover_actividad_empleado');
Route::post('actividades/asignacion_multiple','ActividadesController@asignacion_multiple')->name('asignacion_multiple');

Route::get('actividades/{id_area}/{id_planificacion}/{tipo}/buscar','ActividadesController@buscar_actividad');




//-------------------
Route::get('actividades/{id_area}/{id_planificacion}/buscar','ActividadesController@buscar_actividad2');
Route::get('actividades/{id_area}/{id_planificacion}/buscar2','ActividadesController@buscar_actividad3');
//-----------------------


Route::get('eliminacion/actividades','ActividadesController@buscar_actividades_eliminar')->name('eliminacion.actividades');

Route::get('actividades/{id_area}/buscar_tipo','AsignacionesController@buscar_tipo');
Route::post('actividades/eliminar_actividades_multiple','ActividadesController@eliminar_actividades_multiple')->name('eliminar_actividades_multiple');


Route::get('asignaciones/{id_actividad}/{id_empleado}/eliminar_asignacion','AsignacionesController@eliminar_asignacion');
Route::post('asignaciones/eliminar','AsignacionesController@asignaciones_eliminar');
Route::get('asignaciones/{id_planificacion}/buscar','AsignacionesController@buscar_areas');
Route::get('asignaciones/{id_planificacion}/{id_area}/buscar_dias','AsignacionesController@buscar_dias');
Route::get('areas/{id_gerencia}/buscar','AreasController@buscar_area');
Route::get('asignaciones_g/{id_planificacion}/{id_empleado}/{id_area}/eliminar_asignacion_g','AsignacionesController@eliminar_asignacion_g');

Route::resource('notas','NotasController');
Route::resource('muro','MuroController');
Route::resource('novedades','NovedadesController');
Route::resource('avisos','AvisosController');

Route::post('novedades/eliminar','NovedadesController@eliminar')->name('eliminar_novedades');


Route::post('notas/eliminar','NotasController@destroy')->name('notas.eliminar');

Route::post('editP','PrivilegiosController@editarPrivilegio')->name('editP');

Route::get('mis_actividades/{dia}/{id_planificacion}/{id_area}/buscar','ActividadesController@buscar_mis_actividades')->name('mis_actividades.buscar');
Route::get('mis_actividades2/{id_planificacion}/{id_area}/buscar','ActividadesController@buscar_mis_actividades2')->name('mis_actividades.buscar2');
Route::get('planificaciones/{id_area}/buscar','ActividadesController@buscar_planificacion_por_area');
Route::get('actividades/{id_actividad}/asignada','ActividadesController@asignada');

Route::resource('cursos','CursosController');
Route::resource('examenes','ExamenesController');
Route::resource('licencias','LicenciasController');

// mantenimento
Route::get('backup','MantenimientoController@backup')->name('backup');
Route::get('respaldos','MantenimientoController@index')->name('respaldos.index');
Route::post('respaldo/eliminar','MantenimientoController@eliminar')->name('respaldo.eliminar');
Route::post('respaldo/descargar','MantenimientoController@descargar')->name('respaldo.descargar');


Route::resource('estadisticas1','EstadisticasController');

Route::get('estadisticasHH','EstadisticasController@estadisticasHH')->name('estadisticasHH');
Route::post('estadisticasHH/show','EstadisticasController@estadisticasHH_show')->name('estadisticasHH.show');

Route::post('pdf_area_hh','EstadisticasController@pdf_area_hh')->name('pdf_area_hh');
Route::post('pdf_npi_hh','EstadisticasController@pdf_npi_hh')->name('pdf_npi_hh');
Route::post('pdf_cho_hh','EstadisticasController@pdf_cho_hh')->name('pdf_cho_hh');
Route::post('pdf_area','EstadisticasController@pdf_area')->name('pdf_area');
Route::post('pdf_npi','EstadisticasController@pdf_npi')->name('pdf_npi');
Route::post('pdf_cho','EstadisticasController@pdf_cho')->name('pdf_cho');


Route::get('buscar_areas/{id_area}/editar','ActividadesController@buscar_areas_editar');
Route::get('buscar_planificacion/{id_planificacion}/editar','ActividadesController@buscar_planificacion_editar');
Route::post('eliminacion/validar_clave','ActividadesController@validar_clave')->name('validar');

Route::get('/actividades/{id_actividad}/buscar_actividad_registrada','ActividadesController@buscar_actividad_registrada');


Route::resource('planificaciones','PlanificacionesController');
});
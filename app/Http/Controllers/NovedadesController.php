<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedades;
use App\User;
use App\Empleados;

class NovedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->superUser == 'Eiche') {
            // dd($request->all());

            $create=Novedades::create([
                'titulo' => $request->titulo,
                'novedad' => $request->novedad,
                'tipo' => 'EICHE',
                'fecha' => date(session('fecha_actual').'-m-d'),
                'hora' => date('H:i:s'),
                // 'id_usuario_n' => '',
                'id_empleado' => 4
            ]);


        }
        flash('<i class="icon-circle-check"></i> Mensaje enviado a las novedades!')->success()->important();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        dd('adasasdsd');
    }

    public function eliminar(Request $request)
    {
        if (\Auth::user()->superUser == 'Eiche') {
            $novedad=Novedades::find($request->id_novedad);

            if ($novedad!= null && $novedad->delete()) {
                flash('Novedad eliminada!')->success()->important();
            }else{
                flash('No se encuentra la novedad especificada!')->warning()->important();
            }
        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Muro;
use App\Novedades;
use App\Empleados;
use Illuminate\Http\Request;

class MuroController extends Controller
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
        //dd($request->all());
        $empleado=Empleados::where('id_usuario', \Auth::User()->id)->first();
        $muro= new Muro();
        $muro->id_empleado=$empleado->id;
        $muro->comentario=$request->comentario;
        $muro->fecha=date(session('fecha_actual').'-m-d');
        $muro->hora=date('H:m');
        $muro->save();

        // dd(\Auth::User()->superUser);

        if(\Auth::User()->superUser != 'Eiche'){
            $empleado=Empleados::where('id_usuario', \Auth::User()->id)->first();
            $novedades=Novedades::create([
                'titulo' => '',
                'novedad' => '',
                'tipo' => 'muro',
                'fecha' => date(session('fecha_actual').'-m-d'),
                'hora' => date('H:m:s'),
                'id_usuario_n' => \Auth::User()->id,
                'id_empleado' => $empleado->id

            ]);
        }

        return redirect()->to('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Muro  $muro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $muro = Muro::find($id)->delete();
        return redirect()->to('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Muro  $muro
     * @return \Illuminate\Http\Response
     */
    public function edit(Muro $muro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Muro  $muro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Muro $muro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Muro  $muro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('all');
    }
}

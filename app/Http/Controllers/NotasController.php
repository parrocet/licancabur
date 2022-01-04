<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notas;
use App\Empleados;

class NotasController extends Controller
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
        $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
        //dd($empleado);
        $nota= new Notas();
        $nota->id_empleado=$empleado->id;
        $nota->notas=$request->nota;
        $nota->fecha=date(session('fecha_actual').'-m-d');
        $nota->save();

        return redirect()->to('home');
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
    public function destroy(Request $request)
    {
        $datos = $request['notas'];
        foreach($datos as $selected){
            // dd($selected);
            $notas = Notas::find($selected);
            $notas->delete();
        }
        flash('Nota eliminada con éxito!')->success()->important();
        return redirect()->back();
    }
    public function eliminar(Request $request)
    {
        $datos = $request['notas'];
        //dd($datos);
        foreach($datos as $key){
            //dd($key);
            $notas = Notas::find($key)->delete();
        }
        return redirect()->to('home');
    }
}

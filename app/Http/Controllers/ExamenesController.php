<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examenes;
class ExamenesController extends Controller
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
        $examenes=Examenes::all();

        return view('examenes.index',compact('examenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examenes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscar=Examenes::where('examen',$request->examen)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Exámen ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $examen= new Examenes();
            $examen->examen=$request->examen;
            $examen->descripcion=$request->descripcion;
            $examen->save();

            flash('<i class="icon-circle-check"></i> Exámen registrado exitosamente!')->success()->important();
            return redirect()->to('examenes');
        }
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
    public function edit($id_examen)
    {
        $examen=Examenes::find($id_examen);

        return view('examenes.edit',compact('examen'));
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
        $buscar=Examenes::where('examen',$request->examen)->where('id','<>',$id)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Exámen ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $examen= Examenes::find($id);
            $examen->examen=$request->examen;
            $examen->descripcion=$request->descripcion;
            $examen->status=$request->status;
            $examen->save();

            flash('<i class="icon-circle-check"></i> Exámen actualizado exitosamente!')->success()->important();
            return redirect()->to('examenes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

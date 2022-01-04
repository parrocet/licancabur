<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cursos;
class CursosController extends Controller
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
        $cursos=Cursos::all();
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscar=Cursos::where('curso',$request->curso)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Curso ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $curso= new Cursos();
            $curso->curso=$request->curso;
            $curso->save();

            flash('<i class="icon-circle-check"></i> Curso registrado exitosamente!')->success()->important();
            return redirect()->to('cursos');
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
    public function edit($id_curso)
    {
        $curso=Curso::find($id);

        return view('cursos.edit',compact('curso'));
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
        $buscar=Cursos::where('curso',$request->curso)->where('id','<>',$id)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Curso ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $curso= Cursos::find($id);
            $curso->curso=$request->curso;
            $curso->status=$request->status;
            $curso->save();

            flash('<i class="icon-circle-check"></i> Curso actualizado exitosamente!')->success()->important();
            return redirect()->to('cursos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}

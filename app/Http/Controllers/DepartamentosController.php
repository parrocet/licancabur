<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamentos;

class DepartamentosController extends Controller
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
        $departamentos=Departamentos::all();

        return view('departamentos.index',compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscar=Departamentos::where('departamento',$request->departamento)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Departamento ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $departamento= new Departamentos();
            $departamento->departamento=$request->departamento;
            $departamento->save();

            flash('<i class="icon-circle-check"></i> Departamento registrado exitosamente!')->success()->important();
            return redirect()->to('departamentos');
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
    public function edit($id)
    {
        $departamento=Departamentos::find($id);

        return view('departamentos.edit',compact('departamento'));
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
        $buscar=Departamentos::where('departamento',$request->departamento)->where('id','<>',$id)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Departamento ya registrado verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $departamento= Departamentos::find($id);
            $departamento->departamento=$request->departamento;
            $departamento->save();

            flash('<i class="icon-circle-check"></i> Departamento actualizado exitosamente!')->success()->important();
            return redirect()->to('departamentos');
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

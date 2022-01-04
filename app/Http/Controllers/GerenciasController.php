<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gerencias;
use App\Http\Requests\GerenciasRequest;
class GerenciasController extends Controller
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
        $gerencias=Gerencias::all();

        return view('gerencias.index',compact('gerencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gerencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GerenciasRequest $request)
    {
        //dd($request->all());
        $buscar=Gerencias::where('gerencia',$request->gerencia)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Gerencia ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $gerencia=new Gerencias();
            $gerencia->gerencia=$request->gerencia;
            $gerencia->save();

            flash('<i class="fa fa-check-circle"></i> Gerencia registrada exitosamente!')->success()->important();
            return redirect()->to('gerencias');
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
        $gerencia=Gerencias::find($id);

        return view('gerencias.edit',compact('gerencia'));
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
        //dd($request->all());
        $buscar=Gerencias::where('gerencia',$request->gerencia)->where('id','<>',$id)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Gerencia ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $gerencia= Gerencias::find($id);
            $gerencia->gerencia=$request->gerencia;
            $gerencia->save();

            flash('<i class="icon-circle-check"></i> Gerencia actualizada exitosamente!')->success()->important();
            return redirect()->to('gerencias');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Licencias;
class LicenciasController extends Controller
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
        $licencias=Licencias::all();

        return view('licencias.index',compact('licencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('licencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscar=Licencias::where('licencia',$request->licencia)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Licencia ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $licencia= new Licencias();
            $licencia->licencia=$request->licencia;
            $licencia->save();

            flash('<i class="icon-circle-check"></i> Licencia registrada exitosamente!')->success()->important();
            return redirect()->to('licencias');
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
    public function edit($id_licencia)
    {
        $licencia=Licencias::find($id_licencia);

        return view('licencias.edit',compact('licencia'));
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
        $buscar=Licencias::where('licencia',$request->licencia)->where('id','<>',$id)->count();
        if ($buscar>0) {
            flash('<i class="icon-circle-check"></i> Licencia ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $licencia= Licencias::find($id);
            $licencia->licencia=$request->licencia;
            $licencia->status=$request->status;
            $licencia->save();

            flash('<i class="icon-circle-check"></i> Licencia actualizada exitosamente!')->success()->important();
            return redirect()->to('licencias');
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

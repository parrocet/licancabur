<?php

namespace App\Http\Controllers;

use App\Plantas;
use App\Areas;
use Illuminate\Http\Request;

class PlantasController extends Controller
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
        $plantas=Plantas::all();

        return view('plantas.index',compact('plantas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas=Areas::all();

        return view('plantas.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscar=Plantas::where('planta',$request->planta)->count();
        if ($buscar->count>0) {
            flash('<i class="icon-circle-check"></i> Planta ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $planta=new Plantas();
            $planta->planta=$request->planta;
            $planta->id_area=$request->id_area;
            $planta->save();

            flash('<i class="icon-circle-check"></i> Planta registrada exitosamente!')->success()->important();
            return redirect()->to('plantas');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function show(Plantas $plantas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planta=Plantas::find($id);
        $areas=Areas::all();

        return view('plantas.edit',compact('planta','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $buscar=Plantas::where('planta',$request->planta)->where('id','<>',$id)->count();
        if ($buscar->count>0) {
            flash('<i class="icon-circle-check"></i> Planta ya registrada verifique!')->warning()->important();
            return redirect()->back();
        } else {
            $planta= Plantas::find($id);
            $planta->planta=$request->planta;
            $planta->id_area=$request->id_area;
            $planta->save();

            flash('<i class="icon-circle-check"></i> Planta actualizada exitosamente!')->success()->important();
            return redirect()->to('plantas');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plantas $plantas)
    {
        //
    }
}

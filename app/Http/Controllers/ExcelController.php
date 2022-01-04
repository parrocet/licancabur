<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use App\Exports\ActividadesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ExcelController extends Controller
{

    public function users_view() 
    {
        //dd("DSA");
        return Excel::download(new UsersExport, 'users_view.xlsx');
    }

    public function act_excel() 
    {
        //dd("DSA");
        return Excel::download(new ActividadesExport, 'Actividades.xlsx');
    }
    
    public function actividades() 
    {
        return Excel::download(new ActividadesExport, 'actividades.xlsx');

    }
}

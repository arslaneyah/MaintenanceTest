<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KilometragesImport ;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel ;

class ExcelController extends Controller
{
    public function import(Request $request) 
{
    $file = $request->file ;
    Excel::import(new KilometragesImport, $file);
    return redirect('Gasoil/create');
}

}

<?php

namespace App\Http\Controllers;

use App\Cuve;
use Illuminate\Http\Request;
use App\Gasoil ;
use Auth ;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role==('admin')) {
            $cuves=Cuve::all();
            $cuves=$cuves->except(99);
            return view('welcome')->with(['cuves'=>$cuves]);
        }else
        {
            return redirect('/Gasoil');
        }

    }
}

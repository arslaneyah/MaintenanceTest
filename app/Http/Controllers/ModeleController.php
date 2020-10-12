<?php

namespace App\Http\Controllers;

use App\Marque;
use App\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('Admin');
    }
    public function index()
    {
        $modeles=Modele::all();
        return view('Admin/vehicules/index_modeles')->with('modeles',$modeles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marques=Marque::all();
        return view('Admin/vehicules/create_modele')->with('marques',$marques);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= Auth::user();
        $modeles=Modele::all();
        if ($modeles->contains('modele',$request->input('modele'))){
            return redirect('/Modele/create');
        }else {
            $modele = new Modele();
            $modele->modele = $request->input('modele');
            $modele->marque = $request->input('marque');
            $modele->user_id = $user->id;
            $modele->save();
            return redirect('/Modele');
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
    public function destroy($id)
    {
        //
    }
}

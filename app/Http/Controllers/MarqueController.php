<?php

namespace App\Http\Controllers;

use App\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MarqueController extends Controller
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
        $marques=Marque::all();
        return view('Admin/vehicules/index_marques')->with('marques',$marques);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/vehicules/create_marque');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $marque= new Marque();
        $marque->nom=$request->input('nom');
        $marque->user_id=$user->id ;
        $marque->save();
        return redirect('/Marque');
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
        $marque= Marque::find($id);
        return view('Admin/vehicules/edit_marque')->with('marque',$marque);
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
        $user=Auth::user();
        $marque= Marque::find($id);
        $marque->nom=$request->input('nom');
        $marque->user_id=$user->id ;
        $marque->save();
        return redirect('/Marque');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Marque::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Marque/');
    }
}

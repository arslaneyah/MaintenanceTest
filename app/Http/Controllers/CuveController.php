<?php

namespace App\Http\Controllers;

use App\Alimentation_Cuve;
use App\Cuve;
use App\Unite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CuveController extends Controller
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
        $cuves=Cuve::all();
        return view('Admin/cuves/index')->with('cuves',$cuves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unites=Unite::all();
        return view('Admin/cuves/create')->with('unites',$unites);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuve=new Cuve();
        $cuve->nom= $request->input('nom');
        $cuve->capacite= $request->input('capacite');
        $cuve->quantite_gasoil= $request->input('quantite');
        $cuve->unite_id= $request->input('unite');
        $cuve->save();
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Cuve');
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
        $cuve=Cuve::find($id);
        $unites=Unite::all();
        return view('Admin/cuves/edit')->with('unites',$unites)->with('cuve',$cuve);
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
        $cuve=Cuve::find($id);
        if($id==$request->input('id')){
            $cuve->id=$request->input('id');
            $cuve->nom=$request->input('nom');
            $cuve->quantite_gasoil=$request->input('quantite');
            $cuve->capacite=$request->input('capacite');
            $cuve->unite_id=$request->input('unite');
            $cuve->save();
            Alert::success('Operation Conclue', 'Succés');
            return redirect('/Cuve');
        }else{
            if(is_null(Cuve::find($request->input('id')))){
                $cuve->id=$request->input('id');
                $cuve->nom=$request->input('nom');
                $cuve->quantite_gasoil=$request->input('quantite');
                $cuve->capacite=$request->input('capacite');
                $cuve->unite_id=$request->input('unite');
                $cuve->save();
                Alert::success('Operation Conclue', 'Succés');
                return redirect('/Cuve');

            }else{
                Alert::error('Erreur','Id deja existant');
                return redirect('/Cuve/'.$id.'/edit');

            }
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
        Cuve::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Cuve/');


    }
}

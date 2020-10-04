<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kilometrage ;
use App\Gasoil ;
use App\Vehicule ;
use App\Fournisseur ;
use App\Cuve ;
use App\Alimentation_Cuve ;
use RealRashid\SweetAlert\Facades\Alert;
use Auth ;

class AlimentationCuveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alimcuve = Alimentation_Cuve::All() ;

        return view('AlimentationCuve/cuveindex')->with('alimcuve', $alimcuve);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        $user= Auth::user();
            if($user->role="admin"){
        $cuves = Cuve::where('unite_id','like','33%')->get() ;

        }
        */

        $cuves = Cuve::All() ;
        $fournisseur= Fournisseur::where('etat', 1)->get() ;
        return view('AlimentationCuve/alimentationcuve')->with('cuves', $cuves)->with('fournisseurs', $fournisseur);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuve= Cuve::where('id',$request->input('cuve'))->first();
        $user= Auth::user();
        if($request->input("quantite")>($cuve->capacite)-($cuve->quantite_gasoil)){
            Alert::error('Erreur Quantite Gasoil ', 'Echec : Quantité Gasoil supérieur à la capacité de la cuve');
        }else{
        $alimcuve= new Alimentation_Cuve();
        $alimcuve->quantite=$request->input('quantite') ;
        $alimcuve->cuve_id=$request->input('cuve') ;
        $alimcuve->date= $request->input('date');
        $alimcuve->user_id=$user->id;
        $alimcuve->fournisseur_id=$request->input('fournisseur');
        $cuve->quantite_gasoil= ($cuve->quantite_gasoil)+($alimcuve->quantite);
        $alimcuve->save();
        $cuve->save();
        Alert::success('Operation Conclue', 'Succés');
        }
        return redirect('/Alimentation_Cuve/create');    }

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

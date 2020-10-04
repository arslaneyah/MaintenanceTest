<?php

namespace App\Http\Controllers;

use App\Cuve;
use App\Fournisseur;
use App\Gasoil;
use App\Kilometrage;
use App\Vehicule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth ;
class KilometrageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicules = Vehicule::All();
            return view('Kilometrage/index')->with('vehicules', $vehicules);
        }catch(Exception $e){
            return view('welcome') ;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = Vehicule::All() ;
        return view('Kilometrage/create_kilometrage')->with('vehicules', $vehicules);
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
        $vehicule = Vehicule::where('id',$request->input('vehicule'))->first();
        if($request->input("km")==($vehicule->kilometrage->dernier_km)){
            Alert::error('Kilometrage Erroné ', 'Echec : kilometrage deja introduit');
            return redirect('Kilometrage/create');

        }
        else {
            if($request->input("km")<($vehicule->kilometrage->dernier_km)){
                Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');
                return redirect('Kilometrage/create');

            }
            else {
                $km = new Kilometrage();
                $km->km_avant = $vehicule->kilometrage->dernier_km;
                $km->dernier_km = $request->input('km');
                $km->date = $request->input('date');
                $km->user_id = $user->id;
                $km->save();
                $vehicule->kilometrage_id=$km->id ;
                $vehicule->save();
                Alert::success('Opération Conclue', 'Kilometrage mis a jour avec succés');
                return redirect('Kilometrage/create');

            }
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

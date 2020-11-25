<?php

namespace App\Http\Controllers;

use App\Modele;
use App\Unite;
use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('Admin')->except('statsvehicule');
    }
    public function index()
    {
        $vehicules=Vehicule::all();
        return view('Admin/vehicules/index_vehicules')->with('vehicules',$vehicules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modeles=Modele::all();
        $unites=Unite::all();
        return view('Admin/vehicules/create_vehicule')->with('unites',$unites)->with('modeles',$modeles);
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
        $vehicules=Vehicule::all();
        if($vehicules->contains('n_park',$request->input('npark'))
            || $vehicules->contains('n_chassis',$request->input('nchassis'))
            || $vehicules->contains('matricule',$request->input('matricule')))
        {
            Alert::error('Vehicule Existant', 'Echec : veuillez verifier les informations introduites');
            return redirect('/Vehicule/create');
        }
        else {
            $vehicule = new Vehicule();
            $vehicule->n_park = $request->input('npark');
            $vehicule->n_chassis = $request->input('nchassis');
            $vehicule->matricule = $request->input('matricule');
            $vehicule->annee = $request->input('annee');
            $vehicule->unite_id = $request->input('unite');
            $vehicule->modele_id = $request->input('modele');
            $vehicule->user_id = $user->id;
            $vehicule->save();
            Alert::success('Vehicule Ajouté', 'Véhicule ajouté avec succés');

            return redirect('/Vehicule');
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
        $vehicule=Vehicule::find($id);
        $modeles=Modele::all();
        $unites=Unite::all();
        return view('Admin/vehicules/edit_vehicule')->with('unites',$unites)->with('modeles',$modeles)->with('vehicule',$vehicule);
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
        $vehicules=Vehicule::all()->except($id);
        $vehicule=Vehicule::find($id);
        if($vehicules->contains('n_park',$request->input('npark'))
            || $vehicules->contains('n_chassis',$request->input('nchassis'))
            || $vehicules->contains('matricule',$request->input('matricule')))
        {
            Alert::error('Vehicule Existant', 'Echec : veuillez verifier les informations introduites');
            return redirect('/Vehicule/'.$id.'/edit');
        }
        else {

            $vehicule->n_park = $request->input('npark');
            $vehicule->n_chassis = $request->input('nchassis');
            $vehicule->matricule = $request->input('matricule');
            $vehicule->annee = $request->input('annee');
            $vehicule->unite_id = $request->input('unite');
            $vehicule->modele_id = $request->input('modele');
            $vehicule->user_id = $user->id;
            $vehicule->save();
            Alert::success('Vehicule Modifié', 'Véhicule modifié avec succés');

            return redirect('/Vehicule');
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
        Vehicule::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Marque/');
    }
    public function statsvehicule(){
        try {
            $vehicules = Vehicule::All()->sortBy('n_park');
            return view('Vehicule/createstat')->with('vehicules', $vehicules);
        } catch (Exception $e) {
            return view('welcome');
        }
    }
}

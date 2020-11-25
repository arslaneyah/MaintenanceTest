<?php

namespace App\Http\Controllers;

use App\Cuve;
use App\Fournisseur;
use App\Gasoil;
use App\Kilometrage;
use App\Vehicule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class KilometrageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('Writer',['only' => ['create','store']]);
        $this->middleware('Admin',['only' => ['edit','update','destroy']]);
    }
    public function index()
    {
        $kilometrages=Kilometrage::all()->sortBy('date',SORT_DESC,true);
        return view('Kilometrage/index')->with('kilometrages',$kilometrages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = Vehicule::All()->sortBy('n_park');
        return view('Kilometrage/create_kilometrage')->with('vehicules', $vehicules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $kilometrage = Kilometrage::where('vehicule_id', $request->input('vehicule'))->where('date','<',$request->input('date'))->get();
        $kilometrage=$kilometrage->reverse()->first();
        if (is_null($kilometrage)==false) {
            if ($request->input("km") == ($kilometrage->dernier_km)) {
                Alert::error('Kilometrage Erroné ', 'Echec : kilometrage deja introduit');
                return redirect('Kilometrage/create');

            } else {
                if ($request->input("km") < ($kilometrage->dernier_km) && $request->input('date') >= $kilometrage->date ) {
                    Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');
                    return redirect('Kilometrage/create');

                } else {
                    $km = new Kilometrage();
                    $km->dernier_km = $request->input('km');
                    $km->date = $request->input('date');
                    $km->user_id = $user->id;
                    $km->vehicule_id = $request->input('vehicule');
                    $km->save();
                    Alert::success('Opération Conclue', 'Kilometrage mis a jour avec succés');
                    return redirect('Kilometrage/create');

                }
            }
        }else{
            $km = new Kilometrage();
            $km->dernier_km = $request->input('km');
            $km->date = $request->input('date');
            $km->user_id = $user->id;
            $km->vehicule_id = $request->input('vehicule');
            $km->save();
            Alert::success('Opération Conclue', 'Kilometrage mis a jour avec succés');
            return redirect('Kilometrage/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kilometrage=Kilometrage::find($id);
        $vehicules = Vehicule::All()->sortBy('n_park');
        return view('Kilometrage/edit')->with('vehicules', $vehicules)->with('kilometrage', $kilometrage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $km=Kilometrage::find($id);

                    $km->dernier_km = $request->input('km');
                    $km->date = $request->input('date');
                    $km->user_id = $user->id;
                    $km->vehicule_id = $request->input('vehicule');
                    $km->save();
                    Alert::success('Opération Conclue', 'Kilometrage mis a jour avec succés');
                    return redirect('Kilometrage/');

                }






    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kilometrage::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Kilometrage/');


    }

}

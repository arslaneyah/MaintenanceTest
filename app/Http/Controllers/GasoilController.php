<?php

namespace App\Http\Controllers;

use App\Alimentation_Cuve;
use Illuminate\Http\Request;
use App\Kilometrage;
use App\Gasoil;
use App\Vehicule;
use App\Cuve;
use App\Fournisseur;
use PDF;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exceptions\CustomException;
use Auth;

class GasoilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('Writer', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        try {
            $user = Auth::user();
            if ($user->role == 'admin') {
                $cuves = Cuve::all();
                $cuves = $cuves->except(99);

            } else {
                $unite = $user->unite_id;
                $cuves = Cuve::where('unite_id', $unite)->get();
                $cuves = $cuves->except(99);
            }
            $gasoils = Gasoil::join('kilometrages', 'gasoils.kilometrage_id', '=', 'kilometrages.id')
                ->select('gasoils.*')
                ->orderBy('kilometrages.date', 'desc')
                ->get();

            return view('Gasoil/home')->with('gasoils', $gasoils)->with('cuves', $cuves);
        } catch (Exception $e) {
            return view('welcome');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = Auth::user();
        if ($user->role == "agent") {
            $unite = $user->unite_id;
            $cuves = Cuve::where('unite_id', 'like', $unite . '%')->get();
            $cuves = $cuves->except(99);
        } else {
            $cuves = Cuve::All();
            $cuves = $cuves->except(99);
        }
        $fournisseur = Fournisseur::where('etat', 1)->get();
        $vehicules = Vehicule::All()->sortBy('n_park');
        return view('Gasoil/create')->with('vehicules', $vehicules)->with('fournisseurs', $fournisseur)->with('cuves', $cuves);

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
        $vehicule = Vehicule::where('id', $request->input('vehicule'))->first();
        $kilometrage = Kilometrage::where('vehicule_id', $vehicule->id)->orderby('date', 'desc')->first();
        $gasoil = new Gasoil();
        if (!Gasoil::All()->contains('n_bon', $request->input('n_bon'))) {
            if ($request->input('type') == 1) {
                $cuve = Cuve::where('id', $request->input('cuve'))->first();
                if (!is_null($kilometrage)) {
                    if ($request->input("gasoil") > ($cuve->quantite_gasoil)) {
                        Alert::error('Erreur Quantite Gasoil ', 'Echec : Quantite Gasoil Insuffisante');

                    } else {

                        if (($request->input("km") < ($kilometrage->dernier_km)) && ($request->input("date") >= $kilometrage->date)) {
                            Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');
                        } else {
                            $cuve->quantite_gasoil = ($cuve->quantite_gasoil) - ($request->input('gasoil'));
                            $km = new Kilometrage();
                            $km->dernier_km = $request->input('km');
                            $km->date = $request->input('date');
                            $km->user_id = $user->id;
                            $km->vehicule_id = $vehicule->id;
                            $km->save();
                            $gasoil->kilometrage_id = $km->id;
                            $gasoil->litres = $request->input('gasoil');
                            $gasoil->fournisseur_id = $request->input('fournisseur');
                            $gasoil->cuve_id = $cuve->id;
                            $gasoil->type = $request->input('type');
                            $gasoil->n_bon = $request->input('n_bon');
                            $cuve->save();
                            $gasoil->save();
                            Alert::success('Operation Conclue', 'Succés');
                        }
                    }
                } else{
                    $cuve->quantite_gasoil = ($cuve->quantite_gasoil) - ($request->input('gasoil'));
                    $km = new Kilometrage();
                    $km->dernier_km = $request->input('km');
                    $km->date = $request->input('date');
                    $km->user_id = $user->id;
                    $km->vehicule_id = $vehicule->id;
                    $km->save();
                    $gasoil->kilometrage_id = $km->id;
                    $gasoil->litres = $request->input('gasoil');
                    $gasoil->fournisseur_id = $request->input('fournisseur');
                    $gasoil->cuve_id = $cuve->id;
                    $gasoil->type = $request->input('type');
                    $gasoil->n_bon = $request->input('n_bon');
                    $cuve->save();
                    $gasoil->save();
                    Alert::success('Operation Conclue', 'Succés');
                }

            }
            else {
                $fournisseur = Fournisseur::where('id', $request->input('fournisseur'))->first();
                if (!is_null($kilometrage)) {
                    if ($request->input("km") < ($kilometrage->dernier_km) && ($request->input("date") >= $kilometrage->date)) {
                        Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');

                    } else {
                        $km = new Kilometrage();
                        $km->dernier_km = $request->input('km');
                        $km->date = $request->input('date');
                        $km->user_id = $user->id;
                        $km->vehicule_id = $vehicule->id;
                        $km->save();
                        $litres = 850 / ($fournisseur->prix);
                        $gasoil->kilometrage_id = $km->id;
                        $gasoil->litres = $litres;
                        $gasoil->fournisseur_id = $request->input('fournisseur');
                        $gasoil->cuve_id = $request->input('cuve');
                        $gasoil->type = $request->input('type');
                        $gasoil->n_bon = $request->input('n_bon');
                        $gasoil->save();
                        Alert::success('Operation Conclue', 'Succés');

                    }
                }else{
                    $km = new Kilometrage();
                    $km->dernier_km = $request->input('km');
                    $km->date = $request->input('date');
                    $km->user_id = $user->id;
                    $km->vehicule_id = $vehicule->id;
                    $km->save();
                    $litres = 850 / ($fournisseur->prix);
                    $gasoil->kilometrage_id = $km->id;
                    $gasoil->litres = $litres;
                    $gasoil->fournisseur_id = $request->input('fournisseur');
                    $gasoil->cuve_id = $request->input('cuve');
                    $gasoil->type = $request->input('type');
                    $gasoil->n_bon = $request->input('n_bon');
                    $gasoil->save();
                    Alert::success('Operation Conclue', 'Succés');
                }

        }
        }else {
            Alert::error('Bon Existant', 'Echec : Vous avez introduit un numéro de bon existant');
        }
        return redirect('/Gasoil/create');

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
        $gasoil=Gasoil::find($id);
        $cuves = Cuve::All();
        $cuves = $cuves->except(99);

$fournisseur = Fournisseur::where('etat', 1)->get();
$vehicules = Vehicule::All()->sortBy('n_park');
return view('Gasoil/edit')->with('vehicules', $vehicules)->with('fournisseurs', $fournisseur)->with('cuves', $cuves)->with('gasoil', $gasoil);
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
        $vehicule = Vehicule::where('id', $request->input('vehicule'))->first();
        $kilometrage = Kilometrage::where('vehicule_id', $vehicule->id)->orderby('date', 'desc')->first();
        $gasoil = Gasoil::find($id);
        $km = $gasoil->kilometrage;
        if (!Gasoil::All()->except($gasoil->id)->contains('n_bon', $request->input('n_bon'))) {
            if ($request->input('type') == 1) {
                $cuve = Cuve::find($request->input('cuve'));
                $cuve0 = Cuve::find($gasoil->cuve_id);

                if ($request->input("gasoil") > ($cuve->quantite_gasoil)) {
                    Alert::error('Erreur Quantite Gasoil ', 'Echec : Quantite Gasoil Insuffisante');

                } else {
                    if ($cuve0->id <> $cuve->id){
                        $cuve0->quantite_gasoil = ($cuve->quantite_gasoil) + $gasoil->litres;
                        $cuve->quantite_gasoil = ($cuve->quantite_gasoil) - ($request->input('gasoil'));
                         $cuve0->save();
                        $cuve->save();
                    }else{
                        $cuve->quantite_gasoil = ($cuve->quantite_gasoil) + $gasoil->litres - ($request->input('gasoil'));
                        $cuve->save();
                    }
                        $km->dernier_km = $request->input('km');
                        $km->date = $request->input('date');
                        $km->user_id = $user->id;
                        $km->vehicule_id = $vehicule->id;
                        $km->save();
                        $gasoil->kilometrage_id = $km->id;
                        $gasoil->litres = $request->input('gasoil');
                        $gasoil->fournisseur_id = $request->input('fournisseur');
                        $gasoil->cuve_id = $cuve->id;
                        $gasoil->type = $request->input('type');
                        $gasoil->n_bon = $request->input('n_bon');
                        $gasoil->save();
                        Alert::success('Operation Conclue', 'Succés');
                    }


            } else {
                $fournisseur = Fournisseur::where('id', $request->input('fournisseur'))->first();
                $km->dernier_km = $request->input('km');
                $km->date = $request->input('date');
                $km->user_id = $user->id;
                $km->vehicule_id = $vehicule->id;
                $km->save();
                $litres = 850 / ($fournisseur->prix);
                $gasoil->kilometrage_id = $km->id;
                $gasoil->litres = $litres;
                $gasoil->fournisseur_id = $request->input('fournisseur');
                $gasoil->cuve_id = $request->input('cuve');
                $gasoil->type = $request->input('type');
                $gasoil->n_bon = $request->input('n_bon');
                $gasoil->save();
                Alert::success('Operation Conclue', 'Succés');

            }

            return redirect('/Gasoil/');
        } else {
            Alert::error('Bon Existant', 'Echec : Vous avez introduit un numéro de bon existant');
            return redirect('/Gasoil/' . $id . '/edit');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasoil = Gasoil::find($id);
        if($gasoil->type==1) {
            $cuve = $gasoil->cuve;
            $cuve->quantite_gasoil = $cuve->quantite_gasoil + $gasoil->litres;
            $cuve->save();
        }
        Kilometrage::destroy($gasoil->kilometrage->id);
        Gasoil::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Gasoil/');

    }

    public function Vgasoil(Request $request)
    {
        $gasoils = Gasoil::join('kilometrages', 'gasoils.kilometrage_id', '=', 'kilometrages.id')
            ->where('vehicule_id', $request->input('vehicule'))
            ->whereBetween('date', [$request->input('datemin'), $request->input('datemax')])
            ->select('gasoils.*')
            ->orderBy('kilometrages.date', 'asc')
            ->get();
        $kilometrages = Kilometrage::where('vehicule_id', $request->input('vehicule'))
            ->whereBetween('date', [$request->input('datemin'), $request->input('datemax')])
            ->orderby('date', 'asc')
            ->get();
        $firstg = $gasoils->first();
        if (is_null($firstg) && is_null($kilometrages->first())) {
            Alert::warning('Aucun Suivie Disponible ', "il n'y a aucun suivie pour le moment");
            return redirect('/createstatsvehicule');
        } else {
            if (is_null($firstg) == false) {
                $gasoils = $gasoils->forget(0);
            }
            return view('Vehicule.statistiques')
                ->with('gasoils', $gasoils)
                ->with('firstg', $firstg)
                ->with('kilometrages', $kilometrages);
        }

    }

    public function gasoilfilter(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user->role == 'admin') {
                $cuves = Cuve::all();
                $cuves = $cuves->except(99);

            } else {
                $unite = $user->unite_id;
                $cuves = Cuve::where('unite_id', $unite)->get();
                $cuves = $cuves->except(99);
            }
            $gasoils = Gasoil::join('kilometrages', 'gasoils.kilometrage_id', '=', 'kilometrages.id')
                ->whereBetween('date', [$request->input('datemin'), $request->input('datemax')])
                ->select('gasoils.*')
                ->orderBy('kilometrages.date', 'desc')
                ->get();

            return view('Gasoil/home')->with('gasoils', $gasoils)->with('cuves',$cuves);
        } catch (Exception $e) {
            return view('welcome');
        }
    }

    public function printpdf($id)
    {

        $data = Gasoil::find($id);
        $pdf = PDF::loadView('testpdf', array('n_park' => $data));
        return $pdf->download($data->id . '-' . $data->kilometrage->vehicule->n_park . '-' . $data->kilometrage->date);


    }
}

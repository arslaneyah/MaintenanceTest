<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kilometrage ;
use App\Gasoil ;
use App\Vehicule ;
use App\Cuve ;
use App\Fournisseur ;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exceptions\CustomException;
use Auth ;
class GasoilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
try {
            $gasoils = Gasoil::join('kilometrages', 'gasoils.kilometrage_id', '=', 'kilometrages.id')
                ->select('gasoils.*')
                ->orderBy('kilometrages.date', 'desc')
                ->get() ;

        return view('Gasoil/home')->with('gasoils', $gasoils);
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


        $user= Auth::user();
         /*   if($user->role="admin"){
        $vehicules = Vehicule::where('unite_id',33)->get() ;
        $cuves = Cuve::where('unite_id','like','33%')->get() ;
}*/

        $vehicules = Vehicule::All() ;
        $cuves = Cuve::All();
        $fournisseur= Fournisseur::where('etat', 1)->get() ;
        return view('Gasoil/create')->with('vehicules', $vehicules)->with('fournisseurs', $fournisseur)->with('cuves', $cuves);

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
        if ($request->input('type')==1){
        $cuve = Cuve::where('id', $request->input('cuve') )->first() ;
        if($request->input("gasoil")>($cuve->quantite_gasoil)){
            Alert::error('Erreur Quantite Gasoil ', 'Echec : Quantite Gasoil Insuffisante');

        }else{

            if($request->input("km")==($vehicule->kilometrage->dernier_km)){
                $cuve->quantite_gasoil=($cuve->quantite_gasoil)-($request->input('gasoil')) ;
                $gasoil= new Gasoil();
                $gasoil->vehicule_id= $vehicule->id;
                $gasoil->kilometrage_id=$vehicule->kilometrage_id ;
                $gasoil->litres = $request->input('gasoil');
                $gasoil->fournisseur_id=$request->input('fournisseur');
                $gasoil->cuve_id=$cuve->id ;
                $gasoil->type=$request->input('type') ;
                $gasoil-> save() ;
                $cuve->save() ;
                Alert::success('Operation Conclue', 'Succés');

            }
            else {
                if($request->input("km")<($vehicule->kilometrage->dernier_km)){
                    Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');

                }
                else {
                    $cuve->quantite_gasoil=($cuve->quantite_gasoil)-($request->input('gasoil')) ;
                    $km = new Kilometrage();
                    $km->km_avant = $vehicule->kilometrage->dernier_km;
                    $km->dernier_km = $request->input('km');
                    $km->date = $request->input('date');
                    $km->user_id = $user->id;
                    $km->save();
                    $vehicule->kilometrage_id=$km->id ;
                    $vehicule->save();
                    $gasoil= new Gasoil();
                    $gasoil->vehicule_id= $vehicule->id;
                    $gasoil->kilometrage_id=$km->id ;
                    $gasoil->litres = $request->input('gasoil');
                    $gasoil->fournisseur_id=$request->input('fournisseur');
                    $gasoil->cuve_id=$cuve->id ;
                    $gasoil->type=$request->input('type') ;
                    $cuve->save() ;
                    $gasoil-> save() ;
                    Alert::success('Operation Conclue', 'Succés');
                }
            }

        }

    }else{
            $fournisseur= Fournisseur::where('id',$request->input('fournisseur'))->first();
            if($request->input("km")==($vehicule->kilometrage->dernier_km)){
                $litres =  (($request->input('gasoil'))*850)/($fournisseur->prix);
                $gasoil= new Gasoil();
                $gasoil->vehicule_id= $vehicule->id;
                $gasoil->kilometrage_id=$vehicule->kilometrage_id ;
                $gasoil->litres = $litres;
                $gasoil->fournisseur_id=$request->input('fournisseur');
                $gasoil->cuve_id=$request->input('cuve') ;
                $gasoil->type=$request->input('type') ;
                $gasoil-> save() ;
                Alert::success('Operation Conclue', 'Succés');

            }
            else {
                if($request->input("km")<($vehicule->kilometrage->dernier_km)){
                    Alert::error('Kilometrage Erroné ', 'Echec : Vous avez introduit un kilométrage inférieur au dernier kilométrage');

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
                    $litres =  (($request->input('gasoil'))*850)/($fournisseur->prix);
                    $gasoil= new Gasoil();
                    $gasoil->vehicule_id= $vehicule->id;
                    $gasoil->kilometrage_id=$vehicule->kilometrage_id ;
                    $gasoil->litres = $litres;
                    $gasoil->fournisseur_id=$request->input('fournisseur');
                    $gasoil->cuve_id=$request->input('cuve') ;
                    $gasoil->type=$request->input('type') ;
                    $gasoil-> save() ;
                    Alert::success('Operation Conclue', 'Succés');
                }
            }

        }


        return redirect('Gasoil/create');
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
    public function Vgasoil(Request $request){
        $gasoils = Gasoil::join('kilometrages', 'gasoils.kilometrage_id', '=', 'kilometrages.id')
            ->where('vehicule_id',$request->input('vehicule'))
            ->whereBetween('date', [$request->input('datemin'),$request->input('datemax')])
            ->select('gasoils.*')
            ->orderBy('kilometrages.date', 'asc')
            ->get() ;
        $firstg = $gasoils->first();
        if (is_null($firstg)) {
            Alert::warning('Aucun Suivie Disponible ', "il n'y a aucun suivie pour le moment");
            return redirect('/Kilometrage/');
        }else {
            $gasoils = $gasoils->forget(0);
            return view('Vehicule/statistiques')->with('gasoils', $gasoils)->with('firstg', $firstg);
        }

    }
}

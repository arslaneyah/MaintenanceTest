<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kilometrage;
use App\Gasoil;
use App\Vehicule;
use App\Fournisseur;
use App\Cuve;
use App\Alimentation_Cuve;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class AlimentationCuveController extends Controller
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
        $user = Auth::user();
        if ($user->role == 'admin') {
            $alimcuve = Alimentation_Cuve::All();
            $cuves = Cuve::all();
            $cuves = $cuves->except(99);




        } else {
            $unite = $user->unite_id;
            $alimcuve = Alimentation_Cuve::join('cuves', 'cuve_id', 'cuves.id')
                ->where('unite_id', 'like', $unite)
                ->select('alimentation_cuves.*')
                ->get();
            $cuves = Cuve::where('unite_id', $unite)->get();
            $cuves = $cuves->except(99);
        }

        return view('AlimentationCuve/cuveindex')->with('alimcuve', $alimcuve)->with('cuves', $cuves);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();
        if ($user->role == 'admin') {
            $cuves = Cuve::All();
            $cuves = $cuves->except(99);

        } else {
            $unite = $user->unite_id;
            $cuves = Cuve::where('unite_id', 'like', $unite)->get();
            $cuves = $cuves->except(99);

        }

        $fournisseur = Fournisseur::where('etat', 1)->get();
        return view('AlimentationCuve/alimentationcuve')->with('cuves', $cuves)->with('fournisseurs', $fournisseur);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuve = Cuve::where('id', $request->input('cuve'))->first();
        $user = Auth::user();
        if ($request->input("quantite") > ($cuve->capacite) - ($cuve->quantite_gasoil)) {
            Alert::error('Erreur Quantite Gasoil ', 'Echec : Quantité Gasoil supérieur à la capacité de la cuve');
        } else {
            $alimcuve = new Alimentation_Cuve();
            $alimcuve->quantite = $request->input('quantite');
            $alimcuve->cuve_id = $request->input('cuve');
            $alimcuve->date = $request->input('date');
            $alimcuve->user_id = $user->id;
            $alimcuve->fournisseur_id = $request->input('fournisseur');
            $cuve->quantite_gasoil = ($cuve->quantite_gasoil) + ($alimcuve->quantite);
            $alimcuve->save();
            $cuve->save();
            Alert::success('Operation Conclue', 'Succés');
        }
        return redirect('/Alimentation_Cuve/create');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alicuve = Alimentation_Cuve::find($id);
        $cuve = $alicuve->cuve;
        $cuve->quantite_gasoil = $cuve->quantite_gasoil - $alicuve->quantite;
        $cuve->save();
        Alimentation_Cuve::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Alimentation_Cuve/');


    }

    public function indexdate(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $alimcuve = Alimentation_Cuve::whereBetween('date', [$request->input('datemin'), $request->input('datemax')])
                ->orderBy('date', 'desc')
                ->get();
            $cuves = Cuve::all();
            $cuves = $cuves->except(99);

        } else {
            $unite = $user->unite_id;
            $unite = substr(strval($unite), 0, 2);
            $alimcuve = Alimentation_Cuve::join('cuves', 'cuve_id', 'cuves.id')
                ->where('unite_id', 'like', $unite . '%')
                ->whereBetween('date', [$request->input('datemin'), $request->input('datemax')])
                ->orderBy('date', 'desc')
                ->get();
            $cuves = Cuve::where('unite_id', 'like', $unite)->get();
            $cuves = $cuves->except(99);

        }

        return view('AlimentationCuve/cuveindex')->with('alimcuve', $alimcuve)->with('cuves', $cuves);
    }
}

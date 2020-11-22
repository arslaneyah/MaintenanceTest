<?php

namespace App\Http\Controllers;

use App\Alimentation_Cuve;
use App\Fournisseur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FournisseurController extends Controller
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
        $fournisseurs=Fournisseur::all();
        return view('admin/fournisseurs/index')->with('fournisseurs',$fournisseurs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/fournisseurs/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fournisseur=new Fournisseur();
        $fournisseur->nom= $request->input('nom');
        $fournisseur->prix= $request->input('prix');
        $fournisseur->etat= $request->input('etat');
        $fournisseur->save();
        return redirect('/Fournisseur');
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
        $fournisseur=Fournisseur::find($id);
        return view('admin/fournisseurs/edit')->with('fournisseur',$fournisseur);

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
        $fournisseur=Fournisseur::find($id);
        if($id==$request->input('id')){
            $fournisseur->nom= $request->input('nom');
            $fournisseur->prix= $request->input('prix');
            $fournisseur->etat= $request->input('etat');
            $fournisseur->save();
            Alert::success('Operation Conclue', 'Succés');
            return redirect('/Fournisseur');
        }else{
            if (is_null(Fournisseur::find($request->input('id')))){
                $fournisseur->id=$request->input('id');
                $fournisseur->nom= $request->input('nom');
                $fournisseur->prix= $request->input('prix');
                $fournisseur->etat= $request->input('etat');
                $fournisseur->save();
                Alert::success('Operation Conclue', 'Succés');
                return redirect('/Fournisseur');


            }else{
                Alert::error('Erreur','Id deja existant');
                return redirect('/Fournisseur/'.$id.'/edit');

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
        $fournisseur=Fournisseur::find($id);
        $fournisseur->etat=0;
        $fournisseur->save();
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Fournisseur/');


    }
}

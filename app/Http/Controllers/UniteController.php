<?php

namespace App\Http\Controllers;

use App\Unite;
use App\Wilaya;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UniteController extends Controller
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
        $unites=Unite::all();
        return view('Admin/unites/index')->with('unites',$unites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wilayas=Wilaya::all();
        return view('Admin/unites/create')->with('wilayas',$wilayas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unite= new Unite();
        $unite->id= $request->input('id');
        $unite->name= $request->input('nom');
        $unite->wilaya_id= $request->input('wilaya');
        $unite->save();
        return redirect('/Unite');
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
        $unite=Unite::find($id);
        $wilayas=Wilaya::all();
        return view('Admin/unites/edit')->with('wilayas',$wilayas)->with('unite',$unite);
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
        $unite=Unite::find($id);
        if($id==$request->input('id')){

            $unite->id= $request->input('id');
            $unite->name= $request->input('nom');
            $unite->wilaya_id= $request->input('wilaya');
            $unite->save();
            return redirect('/Unite');
            Alert::success('Operation Conclue', 'Succés');
            return redirect('/Unite');
        }else{
            if(is_null(Unite::find($request->input('id')))){

                $unite->id= $request->input('id');
                $unite->name= $request->input('nom');
                $unite->wilaya_id= $request->input('wilaya');
                $unite->save();
                return redirect('/Unite');
                Alert::success('Operation Conclue', 'Succés');
                return redirect('/Unite');

            }else{
                Alert::error('Erreur','Id deja existant');
                return redirect('/Unite/'.$id.'/edit');

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
        Unite::destroy($id);
        Alert::success('Operation Conclue', 'Succés');
        return redirect('/Unite/');
    }
}

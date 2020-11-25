@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($cuves as $item)
                <div class="col-lg col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-warning">
                        <div class="inner">
                            <h3>{{$item->quantite_gasoil}}L</h3>
                            <h4>/{{$item->capacite}}L</h4>
                            <p>{{$item->nom}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row ">
            <form method="POST" action="/Alimentationcuvefilter">
                @csrf
                <div class="col-sm">
                    <div class="input-group ">

                        <div class="input-group-prepend">
                            <label class="input-group-text" for="optionSelect">Date</label>
                        </div>
                        <input name="datemin" class="form-control col-sm-" type="datetime-local"
                               placeholder="Date Min"
                               required>
                        <input name="datemax" class="form-control col-sm-" type="datetime-local"
                               placeholder="Date Max"
                               required>
                        <div class="input-group-prepend">
                            <button class="input-group-text" type="submit">Valider</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card elevation-3">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="dTable" class="table table-bordered table-hover ">
                        <tr>
                            <th>#</th>
                            <th>Cuve</th>
                            <th>Quantité Alimentée (L)</th>
                            <th>Fournisseur</th>
                            <th>Capacité Cuve</th>
                            <th>Date et Heure</th>
                            <th>Agent</th>
                            @if(Auth::user()->role== 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($alimcuve as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->cuve->nom}}</td>
                                <td>{{$item->quantite}}</td>
                                <td>{{$item->fournisseur->nom}}</td>
                                <td>{{$item->cuve->capacite}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->user->name}}</td>
                                @if(Auth::user()->role== 'admin')
                                    <td>
                                        <form method="post" action="/Alimentation_Cuve/{{$item->id}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="far fa-times-circle"></i></button>
                                            <a class="btn btn-primary btn-sm" href="/Alimentation_Cuve/{{$item->id}}/edit" role="button"><i class="far fa-edit"></i></a>

                                        </form>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


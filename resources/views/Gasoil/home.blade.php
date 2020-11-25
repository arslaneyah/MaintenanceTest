@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($cuves as $item)
                @if($item->quantite_gasoil<1000)
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-gradient-danger">
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
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$gasoils->count()}}</h3>

                        <p>Operations Gasoils</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$gasoils->sum('litres')}}</h3>

                        <p>Litres Consommés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fill-drip"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg col-md-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @php
                            $total=0 ;
                        foreach ($gasoils as $item){
                            $total=$total+ ($item->litres)*($item->fournisseur->prix);
                        }

                        @endphp
                        <h3>{{$total}}</h3>

                        <p>Prix Total</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center mb-1 ">

            <form method="POST" action="/gasoilfilter">
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card elevation-3">
                    <div class="card-body">
                <div class="overflow-auto">
                    <table id="dTable" class="table table-bordered table-hover ">
                        <thead >
                        <tr>
                            <th >#</th>
                            <th>Unité</th>
                            <th>n° Parc</th>
                            <th >Matricule</th>
                            <th>N°bon</th>
                            <th>Kilometrage</th>
                            <th>Date</th>
                            <th>Litres</th>
                            <th>Prix (DA)</th>
                            <th>Type</th>
                            <th>Agent</th>
                                <th>Action</th>

                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($gasoils as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->kilometrage->vehicule->unite->name}}</td>
                                <td>{{$item->kilometrage->vehicule->n_park}}</td>
                                <td>{{$item->kilometrage->vehicule->matricule}}</td>
                                <td>{{$item->n_bon}}</td>
                                <td>{{$item->kilometrage->dernier_km}}</td>
                                <td>{{$item->kilometrage->date}}</td>
                                <td>{{$item->litres}}</td>
                                <td>{{($item->litres)*($item->fournisseur->prix)}}</td>
                                <td>@if($item->type==1)
                                    Par Cuve
                                    @else
                                    Par Bons
                                    @endif
                                </td>
                                <td>{{$item->kilometrage->user->name}}</td>
                                    <td>
                                        @if(Auth::user()->role== 'admin')
                                        <form method="post" action="/Gasoil/{{$item->id}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="far fa-times-circle"></i></button>
                                            <a class="btn btn-primary btn-sm" href="/Gasoil/{{$item->id}}/edit" role="button"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-info btn-sm"  href="/Gasoil/pdfgasoil/{{$item->id}}" role="button"> <i class="fas fa-print"></i> </a>

                                        </form>
                                        @endif
                                    </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="buttonexcel">Excel</button>
            </div>
        </div>
    </div>
@endsection



@extends('layouts.app')
@section('content')
    <div class="container">

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
            <div class="col-sm">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Filtrer</label>
                    </div>
                    <select class="custom-select col" id="optionSelect">
                        <option value="2">n° parc</option>
                        <option value="3">Matricule</option>
                        @if(Auth::user()->role=='admin')
                            <option value="1">Unité</option>
                        @endif

                    </select>
                    <input class="form-control" id="searchinput" onkeyup="search()" type="text"
                           placeholder="Filtre">
                </div>

            </div>

            <form method="POST" action="/gasoilfilter">
                @csrf
                <div class="col">
                    <div class="input-group ">

                        <div class="input-group-prepend">
                            <label class="input-group-text" for="optionSelect">Date</label>
                        </div>
                        <input name="datemin" class="form-control col-sm" type="datetime-local"
                               placeholder="Date Min"
                               required>
                        <input name="datemax" class="form-control col-sm" type="datetime-local"
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
                <div class="overflow-auto">
                    <table id="tableP" class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">#</th>
                            <th onclick="sortTable(1)" scope="col">Unité</th>
                            <th onclick="sortTable(2)" scope="col">n° Parc</th>
                            <th onclick="sortTable(3)" scope="col">Matricule</th>
                            <th onclick="sortTable(4)" scope="col">Kilometrage</th>
                            <th onclick="sortTable(5)" scope="col">Date et Heure</th>
                            <th onclick="sortTable(6)" scope="col">Litres</th>
                            <th onclick="sortTable(7)" scope="col">Prix (DA)</th>
                            <th onclick="sortTable(7)" scope="col">Type</th>
                            <th onclick="sortTable(8)" scope="col">Agent</th>
                            @if(Auth::user()->role== 'admin')
                                <th>Action</th>
                            @endif

                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($gasoils as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->kilometrage->vehicule->unite->name}}</td>
                                <td>{{$item->kilometrage->vehicule->n_park}}</td>
                                <td>{{$item->kilometrage->vehicule->matricule}}</td>
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
                                @if(Auth::user()->role== 'admin')
                                    <td>
                                        <form method="post" action="/Gasoil/{{$item->id}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="far fa-times-circle"></i></button>
                                        </form>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success" id="buttonexcel">Excel</button>
            </div>
        </div>
    </div>
@endsection



@extends('layouts.app')
<html>
<body>
@section('content')
    <div class="container">
        <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#gasoil">Gasoil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kilom">Kilometrage</a>
            </li>
        </ul>
        </div>
        <div class="row justify-content-center">

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Date</label>
                    </div>
                    <input class="form-control col-sm-12" id="searchinputdate" onkeyup="searchdate()" type="date"
                           placeholder="Date">
                </div>

            </div>
            <div class="col-lg-12">

                <div class="tab-content">
                    <div id="gasoil" class=" overflow-auto container tab-pane active">
                        <table id="tableP" class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Unité</th>
                                <th scope="col">n° Parc</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Kilometrage</th>
                                <th scope="col">Date et Heure</th>
                                <th scope="col">Litres</th>
                                <th scope="col">Prix (DA)</th>
                                <th scope="col">Km/100</th>
                            </tr>
                            </thead>

                            <tbody id="table">

                            <tr>
                                <td>{{$firstg->kilometrage->vehicule->unite->name}}</td>
                                <td>{{$firstg->kilometrage->vehicule->n_park}}</td>
                                <td>{{$firstg->kilometrage->vehicule->matricule}}</td>
                                <td>{{$firstg->kilometrage->dernier_km}}</td>
                                <td>{{$firstg->kilometrage->date}}</td>
                                <td>{{$firstg->litres}}</td>
                                <td>{{($firstg->litres)*($firstg->fournisseur->prix)}}</td>
                                @php
                                    $litres=$firstg->litres;
                                    $km=$firstg->kilometrage->dernier_km ;
                                @endphp


                                <td>/</td>
                            </tr>

                            @foreach ($gasoils as $item)
                                <tr>

                                    <td>{{$item->vehicule->unite->name}}</td>
                                    <td>{{$item->vehicule->n_park}}</td>
                                    <td>{{$item->vehicule->matricule}}</td>
                                    <td>{{$item->kilometrage->dernier_km}}</td>
                                    <td>{{$item->kilometrage->date}}</td>
                                    <td>{{$item->litres}}</td>
                                    <td>{{($item->litres)*($item->fournisseur->prix)}}</td>
                                    <td>{{($litres/(($item->kilometrage->dernier_km)-($km)))*100}}</td>
                                    @php
                                        $litres=$item->litres ;
                                        $km=$item->kilometrage->dernier_km ;
                                    @endphp

                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>

                    <div id="kilom" class=" overflow-auto container tab-pane fade">
                        <table id="tableP" class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Unité</th>
                                <th scope="col">n° Parc</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Kilometrage</th>
                                <th scope="col">Date et Heure</th>
                                <th scope="col">Kilometres Parcourues</th>
                            </tr>
                            </thead>

                            <tbody id="table">
                            @php
                                $firstkm=$kilometrages->first();
                                $kmx=$firstkm->dernier_km;
                            @endphp
                            @foreach ($kilometrages as $item)
                                <tr>
                                    <td>{{$item->vehicule->unite->name}}</td>
                                    <td>{{$item->vehicule->n_park}}</td>
                                    <td>{{$item->vehicule->matricule}}</td>
                                    <td>{{$item->dernier_km}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$kmx-$item->dernier_km}}</td>
                                    @php
                                        $kmx=$item->dernier_km;
                                    @endphp
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="buttonexcel">Excel</button>
            </div>
        </div>
    </div>
@endsection

</body>

</html>

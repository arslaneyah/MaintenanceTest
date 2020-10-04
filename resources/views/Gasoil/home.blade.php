@extends('layouts.app')
<html>
<body>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Filtrer</label>
                    </div>
                    <select class="custom-select" id="optionSelect">
                        <option value="2">n° parc</option>
                        <option value="3">Matricule</option>
                    </select>
                    <input class="form-control col-sm-12" id="searchinput" onkeyup="search()" type="text"
                           placeholder="Filtre">
                </div>

            </div>

            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Date</label>
                    </div>
                    <input class="form-control col-sm-12" id="searchinputdate" onkeyup="searchdate()" type="date"
                           placeholder="Date">
                </div>
            </div>
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
                            <th onclick="sortTable(8)" scope="col">Agent</th>
                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($gasoils as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->vehicule->unite->name}}</td>
                                <td>{{$item->vehicule->n_park}}</td>
                                <td>{{$item->vehicule->matricule}}</td>
                                <td>{{$item->vehicule->kilometrage->dernier_km}}</td>
                                <td>{{$item->kilometrage->date}}</td>
                                <td>{{$item->litres}}</td>
                                <td>{{($item->litres)*($item->fournisseur->prix)}}</td>
                                <td>{{$item->kilometrage->user->name}}</td>
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

</body>

</html>

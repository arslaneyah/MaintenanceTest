@extends('layouts.app')
<html>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-group">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Filtrer</label>
                    </div>
                    <select class="custom-select" id="optionSelect">
                        <option value="1">n° park</option>
                        <option value="2">Matricule</option>
                        <option value="7">Unité</option>

                    </select>
                    <input class="form-control col-sm-12" id="searchinput" onkeyup="search()" type="text" placeholder="Filtre">
                </div>

            </div>
            <div class="col-lg-10">
                <div class="overflow-auto">
                    <table class="table table-striped" id="tableP">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">#</th>
                            <th onclick="sortTable(1)" scope="col">n°park</th>
                            <th onclick="sortTable(2)" scope="col">n° chassis</th>
                            <th onclick="sortTable(3)" scope="col">Matricule</th>
                            <th onclick="sortTable(4)" scope="col">Modele</th>
                            <th onclick="sortTable(5)" scope="col">Marque</th>
                            <th onclick="sortTable(6)" scope="col">Année</th>
                            <th onclick="sortTable(7)" scope="col">Unité</th>
                            <th onclick="sortTable(8)" scope="col">Crée Par</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($vehicules as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->n_park}}</td>
                                <td>{{$item->n_chassis}}</td>
                                <td>{{$item->matricule}}</td>
                                <td>{{$item->modele->modele}}</td>
                                <td>{{$item->modele->marque->nom}}</td>
                                <td>{{$item->annee}}</td>
                                <td>{{$item->unite->name}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>
                                    <form method="post" action="/Vehicule/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-times-circle"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

</body>
</html>

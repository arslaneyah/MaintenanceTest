@extends('layouts.app')
<html>
<head>
    <title>Maintenance Tve @yield('title')</title>
</head>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ajouter Véhicules</div>

                    <div class="card-body">
                        <form method="POST" action="/Vehicule">
                            @csrf
                            <div class="form-group">
                                <label for="npark">n° park</label>
                                <input required type="text" class="form-control" id="npark" name="npark"  placeholder="numéro de park">
                            </div>
                            <div class="form-group">
                                <label for="nchassis">n° Chassis</label>
                                <input required type="text" class="form-control" id="nchassis" name="nchassis"  placeholder="numéro de chassis">
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule</label>
                                <input required type="text" class="form-control" id="matricule" name="matricule"  placeholder="ex: 12345-678-99">
                            </div>
                            <div class="form-group">
                                <label for="annee">Année</label>
                                <input required type="number" class="form-control" id="annee" name="annee"  placeholder="ex : 1999" min="1900">
                            </div>

                            <div class="form-group">
                                <span class="form-label">Modele</span>
                                <select required name="modele" class="custom-select custom-select-lg mb-3">
                                    @foreach($modeles as $item )
                                        <option value= "{{$item->id}}">{{$item->marque->nom}}---{{$item->modele}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Unité</span>
                                <select required name="unite" class="custom-select custom-select-lg mb-3">
                                    @foreach($unites as $item )
                                        <option value= "{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>

</html>

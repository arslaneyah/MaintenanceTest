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
                    <div class="card-header">Modifier Véhicules</div>

                    <div class="card-body">
                        <form method="POST" action="/Vehicule/{{$vehicule->id}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="npark">n° park</label>
                                <input value="{{$vehicule->n_park}}" required type="text" class="form-control" id="npark" name="npark"  placeholder="numéro de park">
                            </div>
                            <div class="form-group">
                                <label for="nchassis">n° Chassis</label>
                                <input value="{{$vehicule->n_chassis}}" required type="text" class="form-control" id="nchassis" name="nchassis"  placeholder="numéro de chassis">
                            </div>
                            <div class="form-group">
                                <label for="matricule">Matricule</label>
                                <input value="{{$vehicule->matricule}}" required type="text" class="form-control" id="matricule" name="matricule"  placeholder="ex: 12345-678-99">
                            </div>
                            <div class="form-group">
                                <label for="annee">Année</label>
                                <input value="{{$vehicule->annee}}" required type="number" class="form-control" id="annee" name="annee"  placeholder="ex : 1999" min="1900">
                            </div>

                            <div class="form-group">
                                <span class="form-label">Modele</span>
                                <select required name="modele" class="custom-select custom-select-lg mb-3">
                                    <option value= "{{$vehicule->modele_id}}">{{$vehicule->modele->marque->nom}}---{{$vehicule->modele->modele}}</option>
                                @foreach($modeles->except($vehicule->modele_id) as $item )
                                        <option value= "{{$item->id}}">{{$item->marque->nom}}---{{$item->modele}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Unité</span>
                                <select required name="unite" class="custom-select custom-select-lg mb-3">
                                    <option value= "{{$vehicule->unite_id}}">{{$vehicule->unite->name}}</option>
                                @foreach($unites->except($vehicule->unite_id) as $item )
                                        <option value= "{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>

</html>

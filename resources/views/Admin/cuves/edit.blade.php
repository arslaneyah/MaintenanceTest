@extends('layouts.app')
<html>
<head>
    <title>Maintenance Tve @yield('title')</title>
</head>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier Cuve</div>

                    <div class="card-body">
                        <form method="POST" action="/Cuve/{{$cuve->id}}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="id">Id</label>
                                <input value="{{$cuve->id}}" type="number" class="form-control" id="id" name="id"  placeholder="id">
                            </div>
                            <div class="form-group">
                                <label  for="nom">Désignation</label>
                                <input value="{{$cuve->nom}}" type="text" class="form-control" id="nom" name="nom"  placeholder="designation">
                            </div>
                            <div class="form-group">
                                <label for="prix">Capacité (L)</label>
                                <input value="{{$cuve->capacite}}" type="number" step="0.01" class="form-control" id="capacite" name="capacite"  placeholder="capacite (litres)">
                            </div>
                            <div class="form-group">
                                <label for="prix">Quantité (L)</label>
                                <input value="{{$cuve->quantite_gasoil}}" type="number" step="0.01" class="form-control" id="quantite" name="quantite"  placeholder="quantite (litres)">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Unité</label>
                                <select name="unite" class="custom-select custom-select-lg mb-3">
                                    <option selected value= "{{$cuve->unite->id}}">{{$cuve->unite->name}}</option>
                                @foreach($unites->except($cuve->unite_id) as $item )
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

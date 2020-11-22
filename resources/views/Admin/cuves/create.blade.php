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
                    <div class="card-header">Ajouter Cuve</div>

                    <div class="card-body">
                        <form method="POST" action="/Cuve">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Désignation</label>
                                <input type="text" class="form-control" id="nom" name="nom"  placeholder="designation">
                            </div>
                            <div class="form-group">
                                <label for="prix">Capacité (L)</label>
                                <input type="number" step="0.01" class="form-control" id="capacite" name="capacite"  placeholder="capacite (litres)">
                            </div>
                            <div class="form-group">
                                <label for="prix">Quantité (L)</label>
                                <input type="number" step="0.01" class="form-control" id="quantite" name="quantite"  placeholder="quantite (litres)">
                            </div>

                            <div class="form-group">
                                <span class="form-label">Unité</span>
                                <select name="unite" class="custom-select custom-select-lg mb-3">
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

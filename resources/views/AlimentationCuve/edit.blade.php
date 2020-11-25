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
                    <div class="card-header">Alimentation de cuve</div>

                    <div class="card-body">
                        <form method="POST" action="/Alimentation_Cuve/{{$alimcuve->id}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="quantite">Quantité</label>
                                <input value="{{$alimcuve->quantite}}" type="number" class="form-control" id="quantite" name="quantite"  placeholder="Quantite Alimentée">
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" placeholder="date">
                            </div>

                            <div class="form-group">
                                <label for="cuve">Cuve</label>
                                <select name="cuve" class="custom-select custom-select-lg mb-3">
                                    <option value={{$alimcuve->cuve->id}}>{{$alimcuve->cuve->nom}}</option>
                                @foreach ($cuves->except($alimcuve->cuve_id) as $item )
                                        <option value={{$item->id}}>{{$item->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fournisseur</label>
                                <select name="fournisseur" class="custom-select custom-select-lg mb-3">
                                    <option value={{$alimcuve->fournisseur->id}}>{{$alimcuve->fournisseur->nom}}</option>
                                @foreach ($fournisseurs->except($alimcuve->fournisseur_id) as $item )
                                        <option value={{$item->id}}>{{$item->nom}}</option>
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

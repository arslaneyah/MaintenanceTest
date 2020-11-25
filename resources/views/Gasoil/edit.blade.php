@extends('layouts/app')
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
                    @if($gasoil->type == 1)
                        <div id="gasoilform" class="card-body">
                            <form method="POST" action="/Gasoil/{{$gasoil->id}}">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="km">Kilometrage</label>
                                    <input value="{{$gasoil->kilometrage->dernier_km}}" type="number" class="form-control" id="km" name="km" placeholder="km"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="n_bon">n° Bon</label>
                                    <input value="{{$gasoil->n_bon}}" type="number" class="form-control" id="n_bon" name="n_bon"
                                           placeholder="n_bon"
                                           required min="0">
                                </div>
                                <div class="form-group">
                                    <label for="gasoil">Gasoil</label>
                                    <input value="{{$gasoil->litres}}" type="number" class="form-control" id="gasoil" name="gasoil"
                                           placeholder="gasoil" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="datetime-local" class="form-control" id="date" name="date"
                                           placeholder="date" required>
                                </div>

                                <div class="form-group">
                                    <label>Vehicule</label>
                                    <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                        <option value={{$gasoil->kilometrage->vehicule->id}}>{{$gasoil->kilometrage->vehicule->n_park}}</option>
                                    @foreach ($vehicules->except($gasoil->kilometrage->vehicule->id) as $item )
                                            <option value={{$item->id}}>{{$item->n_park}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($fournisseurs->count()>1)
                                    <div class="form-group">
                                        <label>Fournisseurs</label>
                                        <select name="fournisseur" class="custom-select custom-select-lg mb-3">
                                            <option value={{$gasoil->fournisseur->id}}>{{$gasoil->fournisseur->nom}}</option>
                                            @foreach ($fournisseurs->except($gasoil->fournisseur_id) as $item )
                                                <option value={{$item->id}}>{{$item->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input name="fournisseur" type="hidden" value="{{$fournisseurs[0]->id}}">
                                @endif
                                <input name="type" type="hidden" value="1">
                                <div class="form-group">
                                    <label>Cuve</label>
                                    <select name="cuve" class="custom-select custom-select-lg mb-3">
                                        <option value={{$gasoil->cuve->id}}>{{$gasoil->cuve->nom}}</option>
                                        @foreach ($cuves->except($gasoil->cuve->id) as $item )
                                            <option value={{$item->id}}>{{$item->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    @else
                        <div id="bonessform" class="card-body">
                            <form method="POST" action="/Gasoil/{{$gasoil->id}}">
                                @method('PUT')
                                @csrf

                                <div class="form-group">
                                    <label for="km">Kilometrage</label>
                                    <input type="number" class="form-control" id="km" name="km" placeholder="km"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="gasoil">nombre de bons</label>
                                    <input type="number" class="form-control" id="gasoil" name="gasoil"
                                           placeholder="gasoil" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="datetime-local" class="form-control" id="date" name="date"
                                           placeholder="date" required>
                                </div>

                                <div class="form-group">
                                    <label>Vehicule</label>
                                    <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                        @foreach ($vehicules as $item )
                                            <option value={{$item->id}}>{{$item->n_park}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($fournisseurs->count()>1)
                                    <div class="form-group">
                                        <label>Vehicule</label>
                                        <select name="fournisseur" class="custom-select custom-select-lg mb-3">
                                            @foreach ($fournisseurs as $item )
                                                <option value={{$item->id}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input name="fournisseur" type="hidden" value="{{$fournisseurs[0]->id}}">
                                @endif
                                <input name="type" type="hidden" value="2">
                                <input name="cuve" type="hidden" value="99">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>


                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
</body>

</html>

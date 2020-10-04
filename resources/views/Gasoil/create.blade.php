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
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#gasoilform">Gasoil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bonessform">Bons d'essence</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#gasoilexcelform">Excel</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="gasoilform" class="card-body container tab-pane active">
                            <form method="POST" action="/Gasoil">
                                @csrf
                                <div class="form-group">
                                    <label for="km">Kilometrage</label>
                                    <input type="number" class="form-control" id="km" name="km" placeholder="km"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="gasoil">Gasoil</label>
                                    <input type="number" class="form-control" id="gasoil" name="gasoil"
                                           placeholder="gasoil" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="datetime-local" class="form-control" id="date" name="date"
                                           placeholder="date" required>
                                </div>

                                <div class="form-group">
                                    <span class="form-label">Vehicule</span>
                                    <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                        @foreach ($vehicules as $item )
                                            <option value={{$item->id}}>{{$item->n_park}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($fournisseurs->count()>1)
                                    <div class="form-group">
                                        <span class="form-label">Vehicule</span>
                                        <select name="fournisseur" class="custom-select custom-select-lg mb-3">
                                            @foreach ($fournisseurs as $item )
                                                <option value={{$item->id}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input name="fournisseur" type="hidden" value="{{$fournisseurs[0]->id}}">
                                @endif
                                <input name="type" type="hidden" value="1">
                                <div class="form-group">
                                    <span class="form-label">Cuve</span>
                                    <select name="cuve" class="custom-select custom-select-lg mb-3">
                                        @foreach ($cuves as $item )
                                            <option value={{$item->id}}>{{$item->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div id="bonessform" class="card-body container tab-pane fade">
                            <form method="POST" action="/Gasoil">
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
                                    <span class="form-label">Vehicule</span>
                                    <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                        @foreach ($vehicules as $item )
                                            <option value={{$item->id}}>{{$item->n_park}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($fournisseurs->count()>1)
                                    <div class="form-group">
                                        <span class="form-label">Vehicule</span>
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

                        <div id="gasoilexcelform" class="card-body container tab-pane fade">
                            <form method="POST" action="{{ route ('excelimport')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" required>
                                            <label class="custom-file-label">Telecharger un Fichier</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Importer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
</body>

</html>

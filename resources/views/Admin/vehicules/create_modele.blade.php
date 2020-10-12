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
                    <div class="card-header">Ajouter Modele</div>

                    <div class="card-body">
                        <form method="POST" action="/Modele">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Désignation</label>
                                <input required type="text" class="form-control" id="modele" name="modele"  placeholder="designation">
                            </div>
                            <div class="form-group">
                                <span class="form-label">Marque</span>
                                <select required name="marque" class="custom-select custom-select-lg mb-3">
                                    @foreach($marques as $item )
                                        <option value= "{{$item->id}}">{{$item->nom}}</option>
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

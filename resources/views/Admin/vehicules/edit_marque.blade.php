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
                    <div class="card-header">Ajouter Marque</div>

                    <div class="card-body">
                        <form method="POST" action="/Marque/{{$marque->id}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nom">Désignation</label>
                                <input value="{{$marque->nom}}" required type="text" class="form-control" id="nom" name="nom"  placeholder="designation">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>

</html>

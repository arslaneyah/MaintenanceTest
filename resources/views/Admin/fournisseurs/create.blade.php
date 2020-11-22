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
                    <div class="card-header">Ajouter Fournisseur</div>

                    <div class="card-body">
                        <form method="POST" action="/Fournisseur">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom"  placeholder="nom fournisseur">
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" step="0.01" class="form-control" id="prix" name="prix"  placeholder="prix gasoil">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Etat</label>
                                <select name="etat" class="custom-select custom-select-lg mb-3">
                                        <option value=1>Actif</option>
                                    <option value=0>Inactif</option>
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

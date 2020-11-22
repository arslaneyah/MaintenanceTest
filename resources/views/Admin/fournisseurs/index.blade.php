@extends('layouts.app')
<html>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-lg-5">
            <div class="col-lg-12">
                <div class="card elevation-3">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="dTable" class="table table-bordered table-hover ">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Etat</th>
                            <th>Action</th>

                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($fournisseurs as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->nom}}</td>
                                <td>{{$item->prix}}</td>
                                <td>{{$item->etat}}</td>
                                <td>
                                    <form method="post" action="/Fournisseur/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-times-circle"></i></button>
                                        <a class="btn btn-primary btn-sm" href="/Fournisseur/{{$item->id}}/edit" role="button"><i class="far fa-edit"></i></a>

                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>
</html>

@extends('layouts.app')
<html>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-group">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Filtrer</label>
                    </div>
                    <select class="custom-select" id="optionSelect">
                        <option value="1">Nom</option>
                    </select>
                    <input class="form-control col-sm-12" id="searchinput" onkeyup="search()" type="text" placeholder="Filtre">
                </div>

            </div>
            <div class="col-lg">
                <div class="card elevation-3">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="dTable" class="table table-bordered table-hover ">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Unite</th>
                            <th>Role</th>
                            <th>Actif</th>

                            <th>Action</th>


                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($users as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->unite->name}}</td>
                                <td>{{$item->role}}</td>
                                <td>{{$item->is_active}}</td>

                                <td>
                                    <form method="post" action="/User/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-times-circle"></i></button>
                                        <a class="btn btn-primary btn-sm" href="/User/{{$item->id}}/edit" role="button"><i class="far fa-edit"></i></a>

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

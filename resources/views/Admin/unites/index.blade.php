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
            <div class="col-lg-12">
                <div class="overflow-auto">
                    <table class="table table-striped table-hover" id="tableP">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">#</th>
                            <th onclick="sortTable(1)" scope="col">Nom</th>
                            <th onclick="sortTable(2)" scope="col">Wilaya</th>
                            <th>Action</th>


                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($unites as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->wilaya->name}}</td>
                                <td>
                                    <form method="post" action="/Unite/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-times-circle"></i></button>
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
@endsection

</body>
</html>

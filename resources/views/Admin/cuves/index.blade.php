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
                            <th onclick="sortTable(2)" scope="col">Capacite (litres)</th>
                            <th onclick="sortTable(3)" scope="col">Unité</th>
                            <th onclick="sortTable(3)" scope="col">Quantité (litres)</th>
                            <th>Action</th>

                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($cuves as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->nom}}</td>
                                <td>{{$item->capacite}}</td>
                                <td>{{$item->unite->name}}</td>
                                <td>{{$item->quantite_gasoil}}</td>
                                <td>
                                    <form method="post" action="/Cuve/{{$item->id}}">
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
<script>
    function search() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue, option;
        input = document.getElementById("searchinput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        option =  document.getElementById("optionSelect");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>

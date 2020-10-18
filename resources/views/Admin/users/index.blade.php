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
                <div class="overflow-auto">
                    <table class="table table-striped" id="tableP">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">#</th>
                            <th onclick="sortTable(1)" scope="col">Nom</th>
                            <th onclick="sortTable(2)" scope="col">Email</th>
                            <th >Mot de passe</th>
                            <th onclick="sortTable(4)" scope="col">Unite</th>
                            <th onclick="sortTable(5)" scope="col">Role</th>
                            <th onclick="sortTable(6)" scope="col">Actif</th>

                            <th>Action</th>


                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($users as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->password}}</td>
                                <td>{{$item->unite->name}}</td>
                                <td>{{$item->role}}</td>
                                <td>{{$item->is_active}}</td>

                                <td>
                                    <form method="post" action="/User/{{$item->id}}">
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

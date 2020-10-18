@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($cuves as $item)
                <div class="col-lg col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-warning">
                        <div class="inner">
                            <h3>{{$item->quantite_gasoil}}L</h3>
                            <h4>/{{$item->capacite}}L</h4>
                            <p>{{$item->nom}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row ">
            <div class="col-sm">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="optionSelect">Filtrer</label>
                    </div>
                    <select class="custom-select" id="optionSelect">
                        <option value="1">Cuve</option>
                        <option value="3">Fournisseur</option>
                    </select>
                    <input class="form-control col-sm-12" id="searchinput" onkeyup="search()" type="text"
                           placeholder="Filtre">
                </div>

            </div>
            <form method="POST" action="/Alimentationcuvefilter">
                @csrf
                <div class="col">
                    <div class="input-group ">

                        <div class="input-group-prepend">
                            <label class="input-group-text" for="optionSelect">Date</label>
                        </div>
                        <input name="datemin" class="form-control col-sm-" type="datetime-local"
                               placeholder="Date Min"
                               required>
                        <input name="datemax" class="form-control col-sm-" type="datetime-local"
                               placeholder="Date Max"
                               required>
                        <div class="input-group-prepend">
                            <button class="input-group-text" type="submit">Valider</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="overflow-auto">
                    <table class="table table-striped" id="tableP">
                        <thead class="thead-dark">
                        <tr>
                            <th onclick="sortTable(0)" scope="col">#</th>
                            <th onclick="sortTable(1)" scope="col">Cuve</th>
                            <th onclick="sortTable(2)" scope="col">Quantité Alimentée (L)</th>
                            <th onclick="sortTable(3)" scope="col">Fournisseur</th>
                            <th onclick="sortTable(4)" scope="col">Capacité Cuve</th>
                            <th onclick="sortTable(5)" scope="col">Date et Heure</th>
                            <th onclick="sortTable(6)" scope="col">Agent</th>
                            @if(Auth::user()->role== 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody id="table">

                        @foreach ($alimcuve as $item )

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->cuve->nom}}</td>
                                <td>{{$item->quantite}}</td>
                                <td>{{$item->fournisseur->nom}}</td>
                                <td>{{$item->cuve->capacite}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->user->name}}</td>
                                @if(Auth::user()->role== 'admin')
                                    <td>
                                        <form method="post" action="/Alimentation_Cuve/{{$item->id}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="far fa-times-circle"></i></button>
                                        </form>

                                    </td>
                                @endif
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
        option = document.getElementById("optionSelect");
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


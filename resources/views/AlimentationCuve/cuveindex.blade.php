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
            <option value="2">Quantité</option>
            <option value="1">Cuve</option>
          </select>
          <input class="form-control col-sm-12" id="searchinput" onkeyup="search()" type="text" placeholder="Filtre">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="optionSelect">Date</label>
            </div>
            <input  class="form-control col-sm-12" id="searchinputdate" onkeyup="searchdate()" type="date" placeholder="Date">
          </div>

      </div>
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
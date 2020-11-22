<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <div class="col-6  ">
            <div class="border border-dark my-4 px-4 pt-4 pb-6">
        <div class="text-center">
<h3>Bon de sortie</h3>
    </div>
    <div class="text-sm-left">
        <p class= "">n° Park : {{$n_park->kilometrage->vehicule->n_park}}</p>
    </div>
   <div class="text-sm-left">
        <p>Kilometrage : {{$n_park->kilometrage->dernier_km}} km</p>
   </div>
    <div class="text-sm-left">
        <p>Date :  {{$n_park->kilometrage->date}}</p>
    </div>
        <table class="table ">
            <thead>
            <tr>
                <th >Signature du Chef de Park</th>
                <th>Signature du Chauffeur</th>
            </tr>
            </thead>


        </table>
</div>
</div>
</div>

</body>



</html>

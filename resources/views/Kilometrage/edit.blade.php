@extends('layouts/app')
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
                    <div class="card-header">Modifier Kilometrage</div>
                    <div class="card-body">
                        <form method="POST" action="/Kilometrage/{{$kilometrage->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="km">Kilometrage</label>
                                <input value="{{$kilometrage->dernier_km}}" type="number" class="form-control" id="km" name="km"  placeholder="km" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" placeholder="date" required>
                            </div>

                            <div class="form-group">
                                <label>Vehicule</label>
                                <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                    <option value={{$kilometrage->vehicule->id}}>{{$kilometrage->vehicule->n_park}}</option>
                                @foreach ($vehicules->except($kilometrage->id) as $item )
                                        <option value={{$item->id}}>{{$item->n_park}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
</body>

</html>

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
                    <div class="card-header">Reporter un Kilometrage</div>
                    <div class="card-body">
                        <form method="POST" action="/Kilometrage">
                            @csrf
                            <div class="form-group">
                                <label for="km">Kilometrage</label>
                                <input type="number" class="form-control" id="km" name="km"  placeholder="km" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" id="date" name="date" placeholder="date" required>
                            </div>

                            <div class="form-group">
                                <span class="form-label">Vehicule</span>
                                <select name="vehicule" class="custom-select custom-select-lg mb-3">
                                    @foreach ($vehicules as $item )
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

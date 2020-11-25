@extends('layouts.app')
<html>
<head>
    <title>Maintenance Tve @yield('title')</title>
</head>
<body>
@section('content')
    <div class="container">
        <div class="row justify-content-centerpt-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier Cuve</div>

                    <div class="card-body">
                        <form method="POST" action="/Unite/{{$unite->id}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="id">Id</label>
                                <input value="{{$unite->id}}" type="number" class="form-control" id="id" name="id"  placeholder="id unite">
                            </div>
                            <div class="form-group">
                                <label for="nom">Désignation</label>
                                <input value="{{$unite->name}}" type="text" class="form-control" id="nom" name="nom"  placeholder="designation">
                            </div>
                            <div class="form-group">
                                <span class="form-label">Unité</span>
                                <select name="wilaya" class="custom-select custom-select-lg mb-3">
                                    <option value= "{{$unite->wilaya->id}}">{{$unite->wilaya->name}}</option>
                                    @foreach($wilayas->except($unite->wilaya_id) as $item )
                                        <option value= "{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>

</html>

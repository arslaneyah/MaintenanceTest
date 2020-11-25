@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="row justify-content-center mt-lg-5">
            <div class="col-lg-12">
                <div class="card elevation-3">
                    <div class="card-body">
                        <div class="overflow-auto">
                            <table id="dTable" class="table table-bordered table-hover ">
                                <thead >
                                <tr>
                                    <th >#</th>
                                    <th>n° Parc</th>
                                    <th >Matricule</th>
                                    <th>Kilometrage</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody id="table">

                                @foreach ($kilometrages as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->vehicule->n_park}}</td>
                                        <td>{{$item->vehicule->matricule}}</td>
                                        <td>{{$item->dernier_km}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>
                                            @if(Auth::user()->role== 'admin')
                                                <form method="post" action="/Kilometrage/{{$item->id}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-times-circle"></i></button>
                                                    <a class="btn btn-primary btn-sm" href="/Kilometrage/{{$item->id}}/edit" role="button"><i class="far fa-edit"></i></a>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="buttonexcel">Excel</button>
            </div>
        </div>
    </div>
@endsection



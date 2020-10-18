@extends('layouts/app')


<div class="content overflow-auto">
        @section('content')
            <div class="container">
            <div class="row ">

                @foreach($cuves as $item)
                    <div class="col-lg col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-warning">
                    <div class="inner">
                        <h3>{{$item->quantite_gasoil}}</h3>
                        <p>/{{$item->capacite}}</p>

                        <p>{{$item->nom}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-gas-pump"></i>
                    </div>
            </div>
            </div>
            @endforeach


            </div>

            </div>
        @endsection
</div>

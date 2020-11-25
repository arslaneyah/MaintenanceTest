@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier Utilisateur</div>

                    <div class="card-body">
                        <form class="justify-content-center" method="POST" action="/User/{{$user->id}} ">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="Id" class="col-md-4 col-form-label text-md-right">Id</label>

                                <div class="col-md-6">
                                    <input value="{{$user->id}}" id="id" type="number" class="form-control" name="id" required autocomplete="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                                <div class="col-md-6">
                                    <input value="{{$user->name}}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input value="{{$user->email}}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Nouveau Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="newpassword" min="8">
                                    <span><small>*<u>Renseigner ce champ dans le cas de changement de mot de passe <strong>SINON</strong> laisser vide</u></small></span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Role</label>
                                <select class="custom-select col-md-6" name="role" required>
                                    <option value="admin">Administrateur</option>
                                    <option value="agent">Agent</option>
                                    <option value="supervisor">Superviseur</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Unite</label>
                                <select class="custom-select col-md-6" name="unite" required>
                                    <option value={{$user->unite_id}} >{{$user->unite->name}}</option>
                                @foreach($unites->except($user->unite_id) as $item)
                                        <option value={{$item->id}} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

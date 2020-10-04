@extends('layouts/app')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    </head>
    <body>
        @section('content')
        <form method="POST" action="{{ route ('excelimport')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="file">
              <label class="custom-file-label" >Choose file</label>
            </div>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Submit</button>
            </div>
          </div>
            </div>
        </form>
        @endsection
    </body>
</html>
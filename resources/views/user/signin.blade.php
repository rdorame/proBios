@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Ingresar</h1>
        @if(count($errors) > 0)
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error}}</p>
            @endforeach
          </div>
        @endif
        <form action="{{ route('user.signin')}}" method="post">
            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="password">Contrasenha</label>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success"> Ingresar</button>
            {{csrf_field()}}
        </form>
        <br>
        <p>No tienes una cuenta? <a href="{{ route('user.signup') }}">Crea una aqui</a></p>
    </div>
</div>
@endsection

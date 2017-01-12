@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Registro</h1>
        @if(count($errors) > 0)
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error}}</p>
            @endforeach
          </div>
        @endif
        <form action="{{ route('user.signup')}}" method="post">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="password">Contrasenha</label>
              <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
              <label for="imagePath">Imagen (opcional)</label>
              <input type="text" name="imagePath" id="imagePath" class="form-control">
            </div>
            <button type="submit" class="btn btn-success"> Crear Usuario</button>
            {{csrf_field()}}
        </form>
    </div>
</div>
@endsection

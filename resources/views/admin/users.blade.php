@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<h1>Usuarios registrados</h1>
<hr>
<table class="table table-striped table-bordered">
  <thead>
      <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Correo</td>
          <td>Rango</td>
          <td>Acciones</td>
      </tr>
  </thead>
  <tbody>
@foreach($users as $user => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->name }}</td>
      <td>{{ $value->email }}</td>
      <td>
        @if($value->admin == 'si')
          Administrador
        @else
          Cliente
        @endif
      </td>
      <td>
        @if($value->admin == 'si')
          Administrador
        @else
        {{ Form::open(array('url' => '/admin/users/' . $value->id, )) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Eliminar usuario', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
        @endif


      </td>
    </tr>
@endforeach
</tbody>
</table>
@endsection

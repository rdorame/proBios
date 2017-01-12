@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')

<h1>Todos los productos</h1>
<div class="buttons" style="float: right;">
  <a href="{{ URL::to('products/create') }}" type="button" float="right" name="button" class="btn btn-success">Crear nuevo</a>
  <br>
  <br>
</div>

<table class="table table-striped table-bordered">
  <thead>
      <tr>
          <td>ID</td>
          <td>Producto</td>
          <td>Acciones</td>
      </tr>
  </thead>
  <tbody>
  @foreach($products as $key => $value)
      <tr>
          <td>{{ $value->id }}</td>
          <td>{{ $value->title }}</td>

          <!-- we will also add show, edit, and delete buttons -->
          <td>

              <!-- delete the product (uses the destroy method DESTROY /nerds/{id} -->
                {{ Form::open(array('url' => 'products/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Eliminar producto', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

              <!-- show the product (uses the show method found at GET /products/{id} -->
              <a class="btn btn-small btn-success" href="{{ URL::to('products/' . $value->id) }}">Ver Producto</a>

              <!-- edit this product (uses the edit method found at GET /products/{id}/edit -->
              <a class="btn btn-small btn-info" href="{{ URL::to('products/' . $value->id . '/edit') }}">Editar Producto</a>

          </td>
      </tr>
  @endforeach
  </tbody>
</table>
@endsection

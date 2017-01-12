@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
  <h1>Detalles</h1>
  <div class="buttons" style="float: right;">
    <a href="{{ URL::to('products') }}" type="button" name="button" class="btn btn-success">Ver todos</a>
    <a class="btn btn-small btn-info" href="{{ URL::to('products/' . $product->id . '/edit') }}">Editar</a>
  </div>
  <br>
  <br>
        <div class="jumbotron text-center">
            <h2>{{ $product->title }}</h2>
            <p>
                <strong>Descripcion:</strong> {{ $product->description }}<br>
                <strong>Precio:</strong> ${{ $product->price }}<br>
                <strong>Filtro:</strong> {{ $product->filter }}<br>
                <strong>Tipo:</strong> {{ $product->type }}<br><br>
                <img src="/uploads/productImg/{{ $product -> imagePath }}" alt="img">
            </p>
        </div>

@endsection

@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2 profile">
        <h1>Productos registrados</h1>
        <hr>
        @foreach($products as $product)
        <div class="panel panel-default">
            <div class="panel-body">
              ID: {{ $product->id }} | Nombre: {{ $product->title}} | Precio: ${{ $product->price}}
              <br>
              Descripcion: {{ $product->description}}
              <br>
              Filtro: {{ $product->filter }}  | Tipo: {{ $product->type}}
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection

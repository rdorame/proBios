@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
    <h1>Editar</h1>
    <div class="buttons" style="float: right;">
      <a href="{{ URL::to('products') }}" type="button" name="button" class="btn btn-success">Ver todos</a>
    </div>

    {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) }}
    <br>
    <br>
    <div class="form-group">
        {{ Form::label('title', 'Nombre del producto') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Descripcion') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('filter', 'Filtro') }}
        {{ Form::text('filter', Input::old('filter'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('price', 'Precio') }}
        {{ Form::number('price', Input::old('price'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Tipo') }}
        {{ Form::text('type', Input::old('type'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('imagePath', 'Imagen') }}
        {{ Form::file('imagePath', Input::old('imagePath'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}<a href="#"> </a> <a href="{{ URL::to('products') }}" type="button" name="button" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}

@endsection

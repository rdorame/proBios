@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
    <h1>Create a Nerd</h1>
    <div class="buttons" style="float: right;">
      <a href="{{ URL::to('products') }}" type="button" name="button" class="btn btn-success">Ver todos</a>

    </div>

    {{ Form::open(array('url' => 'products')) }}
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
        <br>

        {{ Form::submit('Crear producto', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection

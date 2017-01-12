@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
  @if(Session::has('success'))
    <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
        <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}

        </div>
      </div>
    </div>
  @endif
  @foreach($products->chunk(3) as $productChunk)
    <div class="row">
      @foreach($productChunk as $product)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="/uploads/productImg/{{ $product -> imagePath }}" alt="img">
            <div class="caption">
              <h3>{{ $product -> title}}</h3>
              <div class="description">
                <p>{{ $product -> description}}</p>
              </div>
              <div class="clearfix">
                <div class="pull-left price">
                  ${{ $product -> price}}
                </div>
                <button  type="button"  class="btn btn-info pull-right"  data-toggle="modal"  data-target="#productModal{{$product->id}}">Ver producto</button>
                <a href="{{ route('product.addToCart', ['id'=> $product->id]) }}" class="btn btn-success pull-right" role="button">Agrega</a>
              </div>

            </div>
          </div>
        </div>
      @endforeach
      @foreach($productChunk as $product)
      <div class="modal fade" id="productModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="productModalLabel">{{$product->title}}</h4>
            </div>
            <div class="modal-body">
              <div class="jumbotron">
                <img src="/uploads/productImg/{{ $product -> imagePath }}" alt="img">
                <p>{{ $product -> description}}</p>
                <div class="pull-left price">
                  ${{ $product -> price}}
                  <p>Tipo de filtro: {{ $product -> filter}}</p>
                  <p>Tipo de planta: {{ $product -> type}}</p>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
              <span class="pull-right">
                <a href="{{ route('product.addToCart', ['id'=> $product->id]) }}" class="btn btn-success pull-right" role="button">Agrega</a>
              </span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  @endforeach
@endsection

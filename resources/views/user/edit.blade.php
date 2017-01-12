@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{ $user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            @if(Auth::user()->admin == 'si')
              <h2>{{ $user->name }} (Administrador) </h2>
            @else
              <h2>{{ $user->name }} </h2>
            @endif
            <br>
            <form enctype="multipart/form-data" action="{{ route('user.profile')}}" method="POST">
                <br>

                <label>Cambiar Imagen</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary" value="Cambiar">
            </form>
        </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2 profile">
        <h1>Perfil del usuario</h1>
        <hr>
        <h2>Mis ordenes:</h2>
        @foreach($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">
                  <strong>Estado de la orden: </strong>{{ $order->status }}
                  @foreach($order->cart->items as $item)
                  <li class="list-group-item">
                      <span class="badge"> ${{ $item['price']}} </span>
                      {{ $item['item']['title'] }} | {{ $item['qty'] }} piezas
                      <br>
                  </li>
                  @endforeach
              </ul>
            </div>
            <div class="panel-footer">
                <strong>Total: ${{ $order->cart->totalPrice }}</strong>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

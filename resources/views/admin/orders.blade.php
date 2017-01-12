@extends('layouts.master')

@section('title')
ProBios
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2 profile">
        <h1>Ordenes registradas</h1>
        <hr>
        @foreach($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">
                  <li class="list-group-item">
                      Numero de orden: {{ $order->id }} | Nombre: {{ $order->name}} | ID: {{ $order->user_id}}
                      <br>
                      <strong>Estado de la orden: </strong>{{ $order->status }}
                  </li>
              </ul>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.plantilla')

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="../../css/cancelarReserva.css">
<title>Eliminar Reserva</title>
@endsection


@section('content')
    
    <div class="form_container">
        <form action="{{route("destroyReserva",$id)}}" method="POST">
            @csrf
            @method("delete")
            <p>¿Esta seguro de que quiere cancelar la reserva para el dia {{$fecha}}?</p>
            <button>Cancelar reserva</button>

        </form>
    </div>

@endsection
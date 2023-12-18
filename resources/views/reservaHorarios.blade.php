@extends("layouts.plantilla")

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/reservaHorario.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ruda&family=Smooch&display=swap" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@endsection

@section("title","reservasHorarios")

@section('content')
<div class="contenedor_formulario">
    <div class="contenedor_nombre">
        <h2>Happening</h2>
    </div>
    <div class="datos_reserva">
        <a href="{{route("reservas")."?local=".session("restaurante")}}">
            <div class="reserva">
                <p>{{session()->get("cantidad_comensales")}} personas</p>
            </div>
        </a>
        <a href="{{route("reservas")."?local=".session("restaurante")}}">
            <div class="reserva">
                <p>{{session()->get("email")}}</p>
            </div>
        </a>
        <a href="{{route("reservaFecha")}}">
            <div class="reserva">
                <p>{{session()->get("fecha_reservada")}}</p>
            </div>
        </a>
    </div>
    <form action='{{route("reservasHorario.create")}}' method="POST" class="form">
        @csrf

        <label for="horario">Horario:</label>
        <input type="text" id="horario" name="horario">
        <div class="contenedor_horarios">
            @foreach (session("horariosDisponibles") as $horario)
            <div class="contenedor_horario" id="{{$horario}}">
                <p>{{$horario}}</p>
            </div>
            @endforeach
        </div>
        @error('horario')
            <p>{{$message}}</p>
        @enderror

        <input type="submit" value="Confirmar Reserva">
    </form>
    @if (session("error"))
    <p class="Response server">{{session("error")}}</p>
    @endif
</div>  
@endsection

@section('scripts')
    <script src="../../js/reservasHorario.js"></script>
@endsection
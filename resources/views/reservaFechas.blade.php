@extends("layouts.plantilla")

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/reservaFechas.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ruda&family=Smooch&display=swap" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@endsection

@section("title","resevasFecha")

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
    </div>
    <form action='{{route("reservasFecha.create")}}' method="POST" class="form">
        @csrf
        <label for="fechas">Eliga una fecha correspondiente</label>
        <input type="fechas" id="fechas" name="fechas">
        <div class="contenedor_fechas">
            @if (session("fechas_disponibles"))
            @foreach (session("fechas_disponibles") as $fecha)
                <div class="fechas" id="{{$fecha}}">
                    <div class="contenedor_dia">
                        @if (date("Y-m-d") == date("Y-m-d",strtotime($fecha)))
                            <p>Today</p>
                        @else
                            <p>{{strftime("%a",strtotime($fecha))}}</p>
                        @endif
                    </div>
                    <div class="contenedor_numero_dia">
                        <p>{{strftime("%e",strtotime($fecha))}}</p>
                    </div>
                    <div class="contenedor_mes">
                        <p>{{strftime("%b",strtotime($fecha))}}</p>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        @error('fechas')
        <p class="responser_server">{{$message}}</p>
        @enderror
    </form>
    @if (session("error"))
    <p class="Response server">{{session("error")}}</p>
    @endif
</div>
@endsection
@section('scripts')
    <script src="../js/reservasFecha.js"></script>
@endsection  
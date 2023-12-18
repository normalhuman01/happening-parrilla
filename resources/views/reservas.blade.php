@extends("layouts.plantilla")

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reservas.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ruda&family=Smooch&display=swap" rel="stylesheet">
@endsection

@section("title","Reserva ".session("restaurante"))

@section("content")

    <div class="contenedor_formulario">
        <div class="contenedor_nombre">
            <h2>Happening</h2>
        </div>
        <form action='{{route('reservas.create')."?local=".request("local")}}' method="POST" class="form">

            @csrf
            <!-- Input para la cantidad de comensales -->
            <div class="cantidad_comensales_container">
                <label for="cantidad_comensales">Eliga la cantidad de comensales</label>
                <input type="number" id="cantidad_comensales" name="cantidad_comensales">
                <div class="numeros_container">
                    
                </div>
            </div>
            <br><br>
            @error('cantidad_comensales')
                <p>{{$message}}</p>
            @enderror
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{old("email")}}" autocomplete="email">
            <br><br>
            @error('email')
                <p>{{$message}}</p>
            @enderror
            <!-- Botón de enviar -->
            <input type="submit" value="Continuar">
        </form>
        @if (session("error"))
        <p class="Response server">{{session("error")}}</p>
    @endif
    </div>  
@endsection

@section('footer')
    {{-- <footer>
        <div class="contenedor_privacidad">
            <p>Powered by <b>MEITRE</b></p>
        </div>
    </footer> --}}
@endsection

@section("scripts")
    <script src="./js/reservas.js"></script>
@endsection
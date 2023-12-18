@extends('layouts.plantilla')

@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ruda&family=Smooch&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ba9bd7b863.js" crossorigin="anonymous"></script>
@endsection

@section('title',"HappeningBuenosAires")
    
@section('header')
<header>
    <div class="header_content">
        <div class="header_content__title">
            <h2>Happenning</h2>
        </div>
        <div class="header_content__subtitles">
            <p>Bar restaurante</p>
            <h4>PARRILLA ARGENTINA</h4>
        </div>
    </div>
    <div class="header__img_container">
        <img src="./imgs/restaurante_foto.jpg" alt="restaurante" title="restauraten_foto">
    </div>
</header>
@endsection


@section('content')
<div class="reservas">
    <div class="reservas_title">
        <h4>Reservas</h4>
    </div>
<div class="restaurantes">
    @foreach ($restaurantes as $restaurante)
    <div class="reservas_lugar">
        <h5>{{$restaurante->ZonaLocal}}</h5>
        <a href="#">{{$restaurante->Direccion}}</a>
        <button><a href='./reservas?local={{$restaurante->Direccion}}'target="_blank">RESERVAR</a></button>
    </div>
@endforeach
</div>

</div>
<div class="sobre_nosotros">
    <div class="sobre_nosotros_first_container">
        <div class="sobre_nostros__img_container">
            <img src="./imgs/comida_restaurante2.png" alt="restaurante_comida" title="restaurate_comida">
        </div>
    </div>
    <div class="sobre_nosotros__content">
        <h5>Sobre Nosotros</h5>
        <p>Fundado en los revolucionarios años 60, es heredero y único representante de la tradición de los legendarios carritos de costanera. 
        Happening es un restaurant que combina parrilla y cocina internacional. Ubicado en Costanera Norte y en Puerto Madero evolucionó hacia 
        la cocina moderna en constante crecimiento. En Happening, el ambiente del restaurante es cálido e ideal para ir con amigos o en familia 
        todos los días de la semana mediodía y noche para disfrutar de comida y el inconfundible marco de la tradición argentina.</p>
    </div>
</div>
<div class="platos">
    <div class="platos__plato_container">
        <div class="plato_container_img">
            <img src="./imgs/milanesa_plato.jpeg" alt="milanesa_con_papas" title="milanesa_con_papas">
        </div>
    </div>
    <div class="platos__plato_container">
        <div class="plato_container_img">
            <img src="./imgs/asado_salsas.jpg" alt="asado" title="asado">
        </div>
    </div>
    <div class="platos__plato_container">
        <div class="plato_container_img">
            <img src="./imgs/mangar_comida.jpg" alt="mangar_comida.jpg" title="mangar_comida">
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer>
    <div class="titulos_footer">
        <h3>Happening</h3>
        <h5>PARRILLA ARGENTINA</h5>
        <p>Buenos aires</p>
    </div>
    <div class="redes_sociales">
        <a href="https://www.facebook.com/HappeningBuenosAires/" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/happeningba/" target="blank"><i class="fa-brands fa-instagram"></i></a>
        <i class="fa-regular fa-envelope"></i>
    </div>
</footer>
@endsection

@section('scripts')
    <script src="./js/main.js"></script>
@endsection

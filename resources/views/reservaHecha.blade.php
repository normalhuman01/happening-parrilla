@extends('layouts.plantilla')

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="../../css/reservado.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ruda&family=Smooch&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/ba9bd7b863.js" crossorigin="anonymous"></script>
@endsection

@section("title","reservaHecha")

@section('content')
    <div class="reserva_container">
        <h2>Su reserva fue realizada</h2>
        <p>Los datos fueron enviados a el email correspondiente</p>
    </div>
@endsection
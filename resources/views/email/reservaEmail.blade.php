<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Su reserva fue realizada con exito</h1>
    <b>Datos de la reserva:</b>
    <ul>
        <li>Direccion:{{$direccion}}</li>
        <li>Fecha:{{$fecha}}</li>
        <li>Horaio:{{$horario}}</li>
        <li>Cantidad de comensales:{{$comensales}}</li>
    </ul>
    <p>En caso de querer cancelar la reserva de click <a href={{$link}}>Aqui</a></p>
</body>
</html>
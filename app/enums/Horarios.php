<?php

namespace App\Enums;

enum Horarios: string{
    case PrimeraHora = "20:00";
    case SegundaHora = "21:00";
    case TerceraHora = "22:00";
    case CuartaHora = "23:00";

    public static function values(): array
    {
       return array_column(self::cases(), 'value');
    }

}
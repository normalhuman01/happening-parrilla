<?php

namespace App\Models;

use App\Enums\Horarios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;


    protected $table = "locales";

    public function reservas(){
        return $this->belongsToMany("App\models\Reserva");
    }

    public function diasDisponibles($LocalID,$fechaActual,$diesDiasDespues){
        //agrupamos por fecha y obtenemos la cantidad de reservas hechas por dia en un rango de las fechas disponibles para reservar
        //utilizamos selectRaw para ejecutar codigo mysql
        $reservas = Reserva::selectRaw("COUNT(*) as cantidad,Fecha")
        //que la fecha este en un rango
        ->whereBetween("Fecha", [$fechaActual, $diesDiasDespues])
        ->where("LocalID", $LocalID)
        ->groupBy("Fecha")
        ->orderBy("Fecha")
        ->get();            


        $diasNoDisponibles = array();
        //por dia en cada uno de los locales solo se podran hacer 16 reservas
        foreach($reservas as $reserva){
            if($reserva->cantidad == 16){
                array_push($diasNoDisponibles,$reserva->Fecha);
            }
        }

        $fechas = array();
        for($i = 0;$i < 10;$i++){
            if($i == 0){
                array_push($fechas,$fechaActual);
            }
            else{
                $fecha = date("Y-m-d",strtotime("+ $i days"));
                array_push($fechas,$fecha);
            }
        }

        //con array_diff lo que hacemos es generar un array de clave valor de aquellos elementos que no formen parte del array1 y array2
        $fechasDisponibles = array_diff($fechas,$diasNoDisponibles);

        session()->put("fechas_disponibles",$fechasDisponibles);


        return redirect()->route("reservaFecha");
    }

    public function horariosDisponibles($fechaIngresada,$restauranteID){
        $reservas = Reserva::selectRaw("COUNT(*) as Cantidad,Horario")
        ->where([["Fecha",$fechaIngresada],["LocalID",$restauranteID]])
        ->groupBy("Horario")
        ->orderBy("Horario")
        ->get();

        $horariosNoDisponibles = array();

        foreach($reservas as $reserva){
            if($reserva->Cantidad >= 4){
                //obtenemos aquellos dias no disponibles
                array_push($horariosNoDisponibles,substr($reserva->Horario, 0, 5));
            }
        }

        $horarios = Horarios::values();


        session()->put("horariosDisponibles",array_diff($horarios,$horariosNoDisponibles));

        return redirect()->route("reservaHorario");
    }

}

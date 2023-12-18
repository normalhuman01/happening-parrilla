<?php

namespace App\Models;

use App\Mail\MailReserva;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Reserva extends Model
{
    use HasFactory;

    protected $table = "reservas";
    protected $primaryKey = 'ReservaID';

    public function locales(){
        return $this->belongsToMany("App\models\Local");
    }


    public function safeReserva($sessionData){
        try{
            $newReserva = new Reserva();

            $newReserva->Cantidad_comensales = $sessionData["cantidad_comensales"];
            $newReserva->Fecha = $sessionData["fecha_reservada"];
            $newReserva->Horario = $sessionData["horario"];
            $newReserva->Email = $sessionData["email"];
            $newReserva->LocalID = $sessionData["restauranteID"];
    
            $newReserva->save();

            Mail::to($sessionData["email"])
            ->send(new MailReserva($sessionData,$newReserva->ReservaID));
    
            return view("reservaHecha");
        }
        catch(\Exception $e){
            return redirect()->route("error_page");
        }
    }

    public function deleteReserva(Reserva $reserva){

        $reserva->delete();

        return redirect()->route("main");

    }

}

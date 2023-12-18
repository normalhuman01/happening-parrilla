<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFechaReserva;
use App\Http\Requests\StoreHorarioReserva;
use App\Http\Requests\StoreInitReserva;
use App\Models\Local;
use App\Models\Reserva;
use Illuminate\Support\Facades\Crypt;


class reservas extends Controller
{
    public function index(){
        try{
            //obtenemos el restaurante del parametro query local
            $local = request("local");

            $restaurante = Local::where("Direccion",$local)->first();

            //en caso de que exista enviamos los valores y guardamos la direccion y el id en la session
            if($restaurante){
                session()->put("restaurante",request("local"));
                session()->put("restauranteID",$restaurante->LocalID);

                return response()->view("reservas",[],200);
            }
            return redirect()->route("error_page");
        }
        //en caso de que exista un error al conectarse a la base de datos o al ejecutar la query
        catch(\Exception $e){
            return redirect()->route("error_page");
        }
    }

    public function initReserva(StoreInitReserva $request){
        //comenzamos con la reserva obteniendo los valores de la cantidad de comensales y el email del usuario
        //en nuestro StoreInitReserva hacemos las validaciones

        //obtenemos el dia actual y 10 dias despues los cuales son la fecha minima y maxima para realizar una reserva
        $hoy = date("Y-m-d");
        $diesDiasDespues = date("Y-m-d",strtotime(" +10 days"));
        
        try{
            //obtenemos los datso de el restaurante
            $local = Local::select("LocalID","Direccion")->where("Direccion",$request->get("local"))->first();
    
            //guardamos los resultados de los input en nuestra session para poder utilizarlos posteriormente
            $request->session()->put("cantidad_comensales",$request->cantidad_comensales);
            $request->session()->put("email",$request->email);
    
            //obtenemos los dias disponibles para aquel restaurante        
            $localModel = new Local();
    
            $diasDisponibles = $localModel->diasDisponibles($local->LocalID,$hoy,$diesDiasDespues);
    
            return $diasDisponibles;
        }
        catch(\Exception $e){
            return redirect()->route("error_page");
        }
    }

    public function reservasFecha(){
        //en caso de que el usuario haya seguido los pasos del registro devolvemos la siguiente view
        if(session("cantidad_comensales") && session("email") && session("restauranteID")){
            return view("reservaFechas");
        }
        return redirect()->route("main");
    }

    public function reservasFechaCreate(StoreFechaReserva $request){
        //guardamos la fecha en nuestra session
        $fecha = $request->fechas;


        $request->session()->put("fecha_reservada",$fecha);

        $local = new Local();

        return $local->horariosDisponibles($fecha,session("restauranteID"));

        return redirect()->route("reservaHorario");
    }

    public function reservasHorario(){
        //en caso de que haya reservado una fecha lo enviamos a la seccion de elegir horario
        if(session("fecha_reservada")){
            return view("reservaHorarios");
        }
        return redirect()->route("reservaFecha");
    }

    public function reservasHorarioCreate(StoreHorarioReserva $request){

        //guardamos el horario en la session
        session()->put("horario",$request->horario);

        $sessionValues = session()->all();

        $reserva = new Reserva();

        //hacemos la reserva
        return $reserva->safeReserva($sessionValues);
    }

    public function deleteReserva($id){
        try{
            $idReserva = Crypt::decryptString($id);

            $reserva = Reserva::where("ReservaID",$idReserva)->first();
    
            $fecha = $reserva->Fecha;
    
            return view("eliminarReserva",compact("id","fecha"));
        }
        catch(\Exception $e){
            return redirect()->route("error_page");
        }
    }

    public function destroy($id){
        try{
            $idReserva = Crypt::decryptString($id);

            $reserva = Reserva::where("ReservaID",$idReserva)->first();

            $cancelarReserva = new Reserva();

            return $cancelarReserva->deleteReserva($reserva);

        }
        catch(\Exception $e){
            return ;
        }  
    }
}


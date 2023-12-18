<?php

namespace Tests\Feature;

use App\Models\Local;
use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ReservasTest extends TestCase
{

  public function test_initReserva(){

    //creamos un nuevo restaurante
    $restaurante = Local::factory()->create([
        "Direccion" => "jorgue123"
    ]);

    //simulamos que el usuario haya realizado una peticion get a un restaurante valido
    $carga = $this->get('/reservas?local='.$restaurante->Direccion);

    //verificamos que de un codigo de estado 200 y que se guarden en session los valores correspondientes
    $carga->assertStatus(200)
    ->assertSessionHas("restaurante",$restaurante->Direccion)
    ->assertSessionHas("restauranteID",$restaurante->LocalID)
    ->assertViewIs("reservas");
  }

  public function test_initReservaFail(){
    //simulamos que no se encuentre el restaurante en concreto

    $cargaFail = $this->get('/reservas?local=merenges');

    $cargaFail->assertStatus(302)
    ->assertRedirect(route("error_page"));
  }

  public function test_initReservaPost(){
    //simulamos que la cantidad de comensales tanto como el mail es correcto pero no hay fechas disponibles
    $restaurante = Local::factory()->make([
      "Direccion" => "jorgue123"
    ]);

    $response = $this->post(route("reservas.create"),["cantidad_comensales"=>2,"email"=>"luisvillab@gmail.com"]);

    //simulamos que entre hoy y los 10 dias ya esta todo reservado
    $diasAreservar = array();
    $reservas = array();
    for($i = 0;$i < 10;$i++){
      $day = date("Y-m-d",strtotime("+$i days"));

      //guardamos en una array todos los dias que se pueden reservar
      array_push($diasAreservar,$day);
      for($i= 0;$i < 16;$i++){
        $fecha = Reserva::factory()->create([
          "Fecha" => $day
        ]);
        //guardamos todas las reservas hechas
        array_push($reservas,$fecha);
      }
    };

    $diasNoDisponibles = array();

    //en caso de que ya hayan 16 reservas con la misma fecha no se va poder reservar en ese dia
    foreach($reservas as $reserva){
      if($reserva->Fecha == 16){
        array_push($diasNoDisponibles,$reserva->Fecha);
      }
    };

    //obtenemos los dias no disponibles
    $diasDisponibles = array_diff($diasAreservar,$diasNoDisponibles);

    $response->assertStatus(302)
    ->assertSessionHas("cantidad_comensales",2)
    ->assertSessionHas("email","luisvillab@gmail.com")
    //verificamos que las fechas no disponibles no se encuentren en la session fechas_disponibles
    ->assertSessionHas("fechas_disponibles",function($fechasDisponibles) use ($diasNoDisponibles){
      //recorro los dias no disponibles y verificamos que esa fecha no este en fechasDisponibles
      foreach($diasNoDisponibles as $fecha){
        $this->assertNotContains($fecha,$fechasDisponibles);
      }
      return true;
    });
  }

  public function test_initReservaPostfail(){
    //simulamos un fallo al iniciar la reserva
    //ingresamos un email y cantidad de comensales invalidos
    $responseFail = $this->post(route("reservas.create"),["cantidad_comensales"=>-2,"email"=>"luis"]);


    //esperamos que nos envie al router reservas
    $responseFail->assertStatus(302)
    ->assertSessionHasErrors(["cantidad_comensales","email"]);
  }

  public function test_reservasFecha(){
    //simulamos que se pudo acceder a la ruta correctamente

    //simulamos que si existan las sesiones correspondientes
    session(["cantidad_comensales"=>2]);
    session(["email"=>"luisvillab@gmail.com"]);
    session(["restauranteID"=>2]);

    $response = $this->get(route("reservaFecha"));

    $response->assertStatus(200)
    ->assertViewIs("reservaFechas");
  }

  public function test_reservasFechaFail(){
    //simulamos que no se pudo acceder a la ruta

    $failResponse = $this->get(route("reservaFecha"));

    $failResponse->assertStatus(302)
    ->assertRedirect(route("main"));
  }

  public function test_reservaFechaPost(){
    //simulamos que la fecha ingresada es valida
    $hoy = date("Y-m-d");

    session(["fechas_disponibles"=>[$hoy]]);


    $response = $this->post(route("reservasFecha.create"),["fechas"=>$hoy]);

    $response
    ->assertStatus(302)
    ->assertRedirect(route("reservaHorario"))
    ->assertSessionHas("fecha_reservada",$hoy);
  }

  public function test_reservaFechaPostFail(){
    //simulamos que la fecha ingresada por parte del usuario no sea valida
    $hoy = date("Y-m-d");
    $mañana = date("Y-m-d",strtotime("+1 days"));

    session(["fechas_disponibles"=>[$hoy]]);

    $response = $this->post(route("reservasFecha.create"),["fechas"=>$mañana]);

    $response->assertStatus(302)
    ->assertSessionHasErrors(["fechas"]);
  }

  public function test_reservaHorarioFail(){
    //simulamos un fallo al hacer una peticion get ya que no existe una fecha eligida
    $response = $this->get(route("reservaHorario"));

    $response->assertStatus(302)
    ->assertRedirect(route("reservaFecha"));
  }

  public function test_reservaHorarioPost(){

    session(["horariosDisponibles"=>["22:00"]]);

    $response = $this->post(route("reservasHorario.create"),["horario"=>"22:00"]);

    $response
    ->assertSessionHas("horario","22:00");
  }

  public function test_reservaHorarioPostFail(){
    //simulamos un fallo en que la fecha ingresada no es valida
    session(["horariosDisponibles"=>["22:00"]]);

    $response = $this->post(route("reservasHorario.create"),["horario"=>"23:00"]);

    $response
    ->assertSessionHasErrors(["horario"]);
  }
}

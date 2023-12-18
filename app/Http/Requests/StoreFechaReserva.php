<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFechaReserva extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {  
        //obtenemos el dia de hoy y de 10 dias despues
        $hoy = strtotime(date("Y-m-d"));
        $diesDiasDespues = strtotime(date("Y-m-d",strtotime(" +10 days")));

        //obtenemos las fechas disponibles
        $fechasDisponibles = session("fechas_disponibles");
        return [
            "fechas"=>["required",
            "date",
            //utilizamos el use para poder acceder a estas variables en nuestra funcion anonima
            function($attribute,$value,$fail) use ($hoy, $diesDiasDespues,$fechasDisponibles){
                $fechaIngresada = strtotime($value);
                //verificamos si la fecha ingresada este entre hoy y 10 dias y tambien si es una fecha disponible
                if(($fechaIngresada < $hoy || $fechaIngresada >= $diesDiasDespues) || (in_array($value,$fechasDisponibles) != 1)){
                    $fail("por favor ingrese una fecha valida");
                }
            }]
        ];
    }

    public function messages()
    {
        return [
            "fechas.date"=>"Fecha tiene que ser de tipo date",
            "fechas.required"=>"Este campo es requerido"
        ];
    }
}

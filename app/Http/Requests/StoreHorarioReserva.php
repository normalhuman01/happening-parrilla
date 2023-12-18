<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Horarios;
use Illuminate\Validation\Rule;

class StoreHorarioReserva extends FormRequest
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
        $horariosDisponibles = session("horariosDisponibles");
        return [
            "horario"=>["required",
            Rule::enum(Horarios::class),
            function($attribute,$value,$fail) use($horariosDisponibles){
                if(!in_array($value,$horariosDisponibles)){
                    $fail("Por favor ingrese un horario valido");
                }
            }]
        ];
    }
}

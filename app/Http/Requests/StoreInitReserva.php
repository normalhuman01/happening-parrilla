<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInitReserva extends FormRequest
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
        return [
            "cantidad_comensales"=>["required","numeric","between:1,4"],
            "email"=>["required","email"]
        ];
    }

    public function messages()
    {
       return [
            "cantidad_comensales.required" => "El campo es requerido",
            "cantidad_comensales.numeric"=>"El campo debe de ser numerico",
            "cantidad_comensales.between"=>"La cantidad de comensales tiene que ser entre 1 y 4",
            "email.required"=>"El email es requerido"
       ];
    }
}

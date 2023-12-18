<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class restaurante extends Controller
{
    public function index(){

        try{
            $restaurantes = Local::select("ZonaLocal","Direccion")->get();
        }
        catch(\Exception $e){
            return redirect()->route("error_page");
        }

        return view("main",compact("restaurantes"));
    }
}

<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $local1 = new Local();
        
        $local1->ZonaLocal = "Puerto madero";
        $local1->Direccion = "Alicia Moreau de Justo 310";

        $local1->save();

        $local2 = new Local();

        $local2->ZonaLocal = "Costanera norte";
        $local2->Direccion = "Av. Rafael Obligado 7030";

        $local2->save();
    }

}

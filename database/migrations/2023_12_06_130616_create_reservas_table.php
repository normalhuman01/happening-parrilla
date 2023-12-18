<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id("ReservaID");
            $table->tinyInteger("Cantidad_comensales");
            $table->date("Fecha");
            $table->time("Horario");
            $table->string("Email");
            $table->unsignedBigInteger("LocalID")->nullable();

            $table->foreign("LocalID")
                    ->references("LocalID")
                    ->on("locales")
                    ->onDelete("set null")
                    ->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('vols', function (Blueprint $table) {
            $table->id();
            $table->string('numero_vol');
            $table->string('from');
            $table->string('to');
            $table->string('date_depart');
            $table->string('date_arrivee');
            $table->decimal('prix', 8, 2);
            $table->decimal('capacite', 8, 2);
            $table->string('compagnieaerienneID');
            $table->timestamps();

            // Clé étrangère
            $table->foreign('compagnieaerienneID')->references('nom')->on('compagnie_aeriennes')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vols');
    }
};

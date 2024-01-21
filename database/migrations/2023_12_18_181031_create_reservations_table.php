<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Exécuter les migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nom_passager');
            $table->string('classe_vol');
            $table->integer('nombre_sieges');
            $table->decimal('prix_total', 8, 2);
            $table->string('vol_id');
            $table->timestamps();

            // Clé étrangère vers la table vols
            $table->foreign('vol_id')->references('numero_vol')->on('vols');
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}

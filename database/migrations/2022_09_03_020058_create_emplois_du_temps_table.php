<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois_du_temps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enseignant_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('classe_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('serie_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('groupe_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('matiere_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('jour_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('horaire_id')
                ->constrained()
                ->onDelete('cascade');

            $table->unique(['enseignant_id', 'jour_id', 'horaire_id'], 'unique_enseignant');

            $table->unique(['classe_id', 'serie_id', 'groupe_id', 'jour_id', 'horaire_id'], 'unique_row');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emplois_du_temps');
    }
};

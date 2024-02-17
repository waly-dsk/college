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
        Schema::create('coefficients', function (Blueprint $table) {

            $table->id();

            $table->foreignId('classe_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('serie_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('matiere_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('coefficient');

            $table->unique(['classe_id', 'serie_id', 'matiere_id'], 'coefficient_unique');

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
        Schema::dropIfExists('coefficients');
    }
};

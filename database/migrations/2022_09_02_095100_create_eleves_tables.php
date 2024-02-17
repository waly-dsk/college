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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();

            $table->string('matricule')->unique();

            $table->string('name')->unique();

            $table->string('email')->unique();

            $table->string('telephone')->unique();

            $table->char('genre');

            $table->date('date_naissance');

            $table->string('lieu_naissance');

            $table->string('avatar');

            $table->foreignId('classe_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('serie_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('groupe_id')
                ->constrained()
                ->onDelete('cascade');

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
        Schema::dropIfExists('eleves');
    }
};

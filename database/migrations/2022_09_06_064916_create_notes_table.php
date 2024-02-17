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
        Schema::create('notes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('eleve_id')->constrained()->onDelete('cascade');

            $table->foreignId('periodicite_devoir_id')->constrained()->onDelete('cascade');

            $table->foreignId('matiere_id')->constrained()->onDelete('cascade');

            $table->foreignId('composition_id')->constrained()->onDelete('cascade');

            $table->foreignId('numero_id')->constrained()->onDelete('cascade');

            $table->decimal('note', 4, 2);

            $table->unique([
                'eleve_id', 'periodicite_devoir_id',
                'matiere_id', 'composition_id', 'numero_id',
            ], 'unique_note');

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
        Schema::dropIfExists('notes');
    }
};

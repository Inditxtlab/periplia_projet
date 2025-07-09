<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); 
            $table->date('date'); 
            $table->string('lieu'); 
            $table->string('description')->nullable(); 
            $table->time('heure_debut'); 
            $table->time('heure_fin'); 
            $table->timestamps();
          $table->foreignUuid('id_voyage')->constrained('voyages', 'id_voyage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};

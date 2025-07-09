<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->uuid('id_voyage')->primary();
            $table->foreignId('id_user')
                  ->constrained('users', 'id_user');
            $table->foreignId('id_categorie')
                  ->constrained('categories', 'id_categorie');
            $table->string('nom_voyage');
            $table->string('destination'); 
            $table->string('description')->nullable(); 
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nombre_voyageurs');
            $table->enum('status', ['a_venir', 'en_route', 'termine'])->default('a_venir'); 
            $table->boolean('visibilite'); 
            $table->string('image_couverture')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};

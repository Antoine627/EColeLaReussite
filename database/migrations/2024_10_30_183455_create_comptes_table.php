<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id('id_compte'); // Crée la colonne id_compte avec auto-increment
            $table->string('nom_compte', 100); // Colonne pour le nom du compte
            $table->decimal('solde', 10, 2); // Colonne pour le solde
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};

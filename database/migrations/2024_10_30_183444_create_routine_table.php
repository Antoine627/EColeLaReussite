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
        Schema::create('routine', function (Blueprint $table) {
            $table->id('id_routine'); // Crée la colonne id_routine avec auto-increment
            $table->foreignId('id_eleve') // Colonne pour la clé étrangère id_eleve
                  ->constrained('eleves') // Indique que cette colonne référence la table 'eleves'
                  ->onDelete('cascade'); // Supprime la routine si l'élève est supprimé
            $table->date('date'); // Colonne pour la date
            $table->string('activite', 255); // Colonne pour l'activité
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine');
    }
};

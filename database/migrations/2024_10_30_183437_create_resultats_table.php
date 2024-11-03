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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id('id_resultat'); // Crée la colonne id_resultat avec auto-increment
            $table->foreignId('id_eleve') // Colonne pour la clé étrangère id_eleve
                  ->constrained('eleves') // Indique que cette colonne référence la table 'eleves'
                  ->onDelete('cascade'); // Supprime les résultats si l'élève est supprimé
            $table->string('matiere', 100); // Colonne pour la matière
            $table->decimal('note', 5, 2)->nullable(); // Colonne pour la note, nullable
            $table->string('annee_scolaire', 10); // Colonne pour l'année scolaire
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};

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
        Schema::create('presences_eleves', function (Blueprint $table) {
            $table->id('id_presence_eleve'); // Crée la colonne id_presence_eleve avec auto-increment
            $table->foreignId('id_eleve') // Colonne pour la clé étrangère id_eleve
                  ->constrained('eleves') // Indique que cette colonne référence la table 'eleves'
                  ->onDelete('cascade'); // Supprime les présences si l'élève est supprimé
            $table->date('date_presence'); // Colonne pour la date de présence
            $table->enum('statut', ['Présent', 'Absent']); // Colonne pour le statut de présence
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences_eleves');
    }
};

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
        Schema::create('presences_employes', function (Blueprint $table) {
            $table->id('id_presence_employe'); // Crée la colonne id_presence_employe avec auto-increment
            $table->foreignId('id_employe') // Colonne pour la clé étrangère id_employe
                  ->constrained('employes') // Indique que cette colonne référence la table 'employes'
                  ->onDelete('cascade'); // Supprime les présences si l'employé est supprimé
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
        Schema::dropIfExists('presences_employes');
    }
};

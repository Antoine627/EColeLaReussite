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
        Schema::create('paie', function (Blueprint $table) {
            $table->id('id_paie'); // Crée la colonne id_paie avec auto-increment
            $table->foreignId('id_employe') // Colonne pour la clé étrangère id_employe
                  ->constrained('employes') // Indique que cette colonne référence la table 'employes'
                  ->onDelete('cascade'); // Supprime la paie si l'employé est supprimé
            $table->decimal('montant', 10, 2); // Colonne pour le montant
            $table->date('date_paiement'); // Colonne pour la date de paiement
            $table->timestamps(); // Colonne pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paie');
    }
};

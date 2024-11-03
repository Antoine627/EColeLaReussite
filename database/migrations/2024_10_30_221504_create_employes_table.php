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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identification')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('poste');
            $table->decimal('salaire', 10, 2);
            $table->string('sexe');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};

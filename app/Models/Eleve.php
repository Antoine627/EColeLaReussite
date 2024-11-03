<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    // Déclarez les attributs que le modèle peut remplir
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'adresse',
        'telephone',
        'date_inscription',
        'numero_matricule',
        'photo',
    ];

    // Formatez les dates si nécessaire
    protected $dates = [
        'date_naissance',
        'date_inscription',
    ];


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function presences()
    {
        return $this->hasMany(PresenceEleve::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'niveau',
        'capacite',
        'description', // Ajoutez d'autres champs selon vos besoins
        // 'autres_champs' => 'type',
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}
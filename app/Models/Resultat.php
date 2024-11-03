<?php
// app/Models/Resultat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resultat extends Model
{
    protected $fillable = [
        'eleve_id',
        'matiere',
        'note',
        'periode',
        'commentaire',
    ];

    public function eleve(): BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }
}

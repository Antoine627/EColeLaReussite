<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PresenceEleve extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'eleve_id',
        'date',
        'status',
        'heure_arrivee',
        'commentaire'
    ];

    /**
     * Les attributs qui doivent être convertis en dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'heure_arrivee',
        'created_at',
        'updated_at'
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'heure_arrivee' => 'datetime',
    ];

    /**
     * Relation avec l'élève
     */
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    /**
     * Scope pour filtrer par date
     */
    public function scopeParDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    /**
     * Scope pour filtrer par mois
     */
    public function scopeParMois($query, $annee, $mois)
    {
        return $query->whereYear('date', $annee)
                    ->whereMonth('date', $mois);
    }

    /**
     * Scope pour filtrer par classe
     */
    public function scopeParClasse($query, $classe_id)
    {
        return $query->whereHas('eleve', function ($q) use ($classe_id) {
            $q->where('classe_id', $classe_id);
        });
    }

    /**
     * Scope pour les présents
     */
    public function scopePresents($query)
    {
        return $query->where('status', 'present');
    }

    /**
     * Scope pour les absents
     */
    public function scopeAbsents($query)
    {
        return $query->where('status', 'absent');
    }

    /**
     * Scope pour les retards
     */
    public function scopeRetards($query)
    {
        return $query->where('status', 'retard');
    }

    /**
     * Vérifie si l'élève est en retard
     */
    public function estEnRetard()
    {
        return $this->status === 'retard';
    }

    /**
     * Vérifie si l'élève est absent
     */
    public function estAbsent()
    {
        return $this->status === 'absent';
    }

    /**
     * Vérifie si l'élève est présent
     */
    public function estPresent()
    {
        return $this->status === 'present';
    }

    /**
     * Récupère les statistiques de présence pour un élève sur une période donnée
     */
    public static function getStatistiquesEleve($eleve_id, $debut = null, $fin = null)
    {
        $debut = $debut ?: Carbon::now()->startOfMonth();
        $fin = $fin ?: Carbon::now()->endOfMonth();

        $presences = self::where('eleve_id', $eleve_id)
            ->whereBetween('date', [$debut, $fin])
            ->get();

        return [
            'total' => $presences->count(),
            'presents' => $presences->where('status', 'present')->count(),
            'absents' => $presences->where('status', 'absent')->count(),
            'retards' => $presences->where('status', 'retard')->count(),
            'taux_presence' => $presences->count() > 0 
                ? round(($presences->whereIn('status', ['present', 'retard'])->count() / $presences->count()) * 100, 2)
                : 0
        ];
    }

    /**
     * Récupère les statistiques de présence pour une classe sur une période donnée
     */
    public static function getStatistiquesClasse($classe_id, $debut = null, $fin = null)
    {
        $debut = $debut ?: Carbon::now()->startOfMonth();
        $fin = $fin ?: Carbon::now()->endOfMonth();

        $presences = self::whereHas('eleve', function ($query) use ($classe_id) {
            $query->where('classe_id', $classe_id);
        })
        ->whereBetween('date', [$debut, $fin])
        ->get();

        return [
            'total' => $presences->count(),
            'presents' => $presences->where('status', 'present')->count(),
            'absents' => $presences->where('status', 'absent')->count(),
            'retards' => $presences->where('status', 'retard')->count(),
            'taux_presence' => $presences->count() > 0 
                ? round(($presences->whereIn('status', ['present', 'retard'])->count() / $presences->count()) * 100, 2)
                : 0
        ];
    }

    /**
     * Marque un élève comme présent
     */
    public static function marquerPresent($eleve_id, $date = null, $heure_arrivee = null)
    {
        $date = $date ?: Carbon::today();
        $heure_arrivee = $heure_arrivee ?: Carbon::now();

        return self::updateOrCreate(
            [
                'eleve_id' => $eleve_id,
                'date' => $date,
            ],
            [
                'status' => 'present',
                'heure_arrivee' => $heure_arrivee,
            ]
        );
    }

    /**
     * Marque un élève comme absent
     */
    public static function marquerAbsent($eleve_id, $date = null, $commentaire = null)
    {
        $date = $date ?: Carbon::today();

        return self::updateOrCreate(
            [
                'eleve_id' => $eleve_id,
                'date' => $date,
            ],
            [
                'status' => 'absent',
                'commentaire' => $commentaire,
            ]
        );
    }

    /**
     * Marque un élève en retard
     */
    public static function marquerRetard($eleve_id, $date = null, $heure_arrivee = null, $commentaire = null)
    {
        $date = $date ?: Carbon::today();
        $heure_arrivee = $heure_arrivee ?: Carbon::now();

        return self::updateOrCreate(
            [
                'eleve_id' => $eleve_id,
                'date' => $date,
            ],
            [
                'status' => 'retard',
                'heure_arrivee' => $heure_arrivee,
                'commentaire' => $commentaire,
            ]
        );
    }
}
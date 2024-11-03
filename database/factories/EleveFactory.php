<?php 

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EleveFactory extends Factory
{
    protected $model = \App\Models\Eleve::class;

    public function definition()
    {
        // Listes de noms et prénoms courants au Sénégal
        $noms = ['Diop', 'Fall', 'Sow', 'Ndiaye', 'Diallo', 'Ba', 'Gueye', 'Faye', 'Seck', 'Dieng'];
        $prenoms = ['Awa', 'Moussa', 'Aminata', 'Fatou', 'Ibrahima', 'Mamadou', 'Seynabou', 'Demba', 'Ndongo', 'Bineta'];
        
        return [
            'nom' => $this->faker->randomElement($noms),
            'prenom' => $this->faker->randomElement($prenoms),
            'date_naissance' => $this->faker->dateTimeBetween('-18 years', '-10 years')->format('Y-m-d'),
            'sexe' => $this->faker->randomElement(['M', 'F']),
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->unique()->phoneNumber,
            'numero_matricule' => 'MAT-' . strtoupper(Str::random(5)),
            'photo' => 'default.jpg',  // Peut être modifié pour inclure un chemin d'image
            'date_inscription' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

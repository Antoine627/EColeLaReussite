<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Affiche la liste des classes.
     */
    public function index()
    {
        $classes = Classe::all();
        return view('classes.index', compact('classes'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle classe.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Enregistre une nouvelle classe.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:255', // Ajoutez d'autres validations selon vos besoins
        ]);

        Classe::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès.');
    }

    /**
     * Affiche les détails d'une classe spécifique.
     */
    public function show(Classe $classe)
    {
        return view('classes.show', compact('classe'));
    }

    /**
     * Affiche le formulaire d'édition pour une classe spécifique.
     */
    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    /**
     * Met à jour une classe spécifique.
     */
    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:255', // Ajoutez d'autres validations selon vos besoins
        ]);

        $classe->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Supprime une classe spécifique.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès.');
    }
}
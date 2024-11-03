<!-- resources/views/eleves/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Modifier un élève</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('eleves.update', $eleve->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ $eleve->nom }}" required>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $eleve->prenom }}" required>
    </div>

    <div class="form-group">
        <label for="date_naissance">Date de naissance</label>
        <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ $eleve->date_naissance }}" required>
    </div>

    <div class="form-group">
        <label for="sexe">Sexe</label>
        <select name="sexe" id="sexe" class="form-control" required>
            <option value="M" {{ $eleve->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ $eleve->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $eleve->adresse }}">
    </div>

    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" class="form-control" value="{{ $eleve->telephone }}">
    </div>

    <div class="form-group">
        <label for="date_inscription">Date d'inscription</label>
        <input type="date" name="date_inscription" id="date_inscription" class="form-control" value="{{ $eleve->date_inscription }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection

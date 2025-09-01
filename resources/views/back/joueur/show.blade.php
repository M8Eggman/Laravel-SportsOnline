@extends('layouts.back')

@section('content')
    <div class="container my-5">
        <h2>Détails du joueur : {{ $joueur->first_name }} {{ $joueur->last_name }}</h2>
        <div class="card" style="width: 18rem;">
            <img src="{{ $joueur->photo->src ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
            <div class="card-body">
                <p class="card-text"><strong>Nom :</strong> {{ $joueur->last_name }}</p>
                <p class="card-text"><strong>Prénom :</strong> {{ $joueur->first_name }}</p>
                <p class="card-text"><strong>Âge :</strong> {{ $joueur->age }}</p>
                <p class="card-text"><strong>Position :</strong> {{ $joueur->position->name ?? '-' }}</p>
                <p class="card-text"><strong>Équipe :</strong> {{ $joueur->equipe->name ?? 'Sans équipe' }}</p>
                <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn btn-warning">Modifier</a>
                <a href="{{ route('back.joueur.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.back')

@section('title', "Détails de l'utilisateur")

@section('content')
    <div class="container mt-4">
        <h1>Détails de l'utilisateur</h1>
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <h4 class="card-title">
                    {{ $user->first_name }} {{ $user->last_name }}
                </h4>
                <p><strong>Email :</strong> {{ $user->email }}</p>
                <p>
                    <strong>Rôle :</strong>
                    @if($user->role)
                        <span class="badge bg-info">{{ $user->role->name }}</span>
                    @else
                        <span class="text-muted">Aucun rôle</span>
                    @endif
                </p>
                <p>
                    <strong>Email vérifié :</strong>
                    @if($user->email_verified_at)
                        <span class="badge bg-success">Oui ({{ $user->email_verified_at->format('d/m/Y H:i') }})</span>
                    @else
                        <span class="badge bg-secondary">Non</span>
                    @endif
                </p>
                <p><strong>Date de création :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($user->equipe && count($user->equipe) > 0)
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title">Équipes créées</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($user->equipe as $equipe)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $equipe->name }}
                                <a href="{{ route('equipe.show', $equipe->id) }}" class="btn btn-sm btn-outline-info">Voir</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($user->joueur && count($user->joueur) > 0)
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title">Joueurs créés</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($user->joueur as $joueur)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $joueur->first_name }} {{ $joueur->last_name }}
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn btn-sm btn-outline-info">Voir</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ route('back.user.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <a href="{{ route('back.user.edit', $user->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
@endsection
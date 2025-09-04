@extends('layouts.back')

@section('title', 'Détails du Joueur')

@section('content')
    <div class="page-player">

        <h1 class="table-title">Profil du joueur <span class="table-title-name">{{ $joueur->last_name }}
                {{ $joueur->first_name }}</span></h1>

        <div class="table-header">
            <a href="{{ route('back.joueur.index') }}" class="btn-valo small">Retour</a>

            @can('update-joueur', $joueur)
                <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn-valo small info">Modifier</a>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert-success-valo">
                {{ session('success') }}
            </div>
        @endif

        <div class="player-show-container" style="display:flex; gap:2rem;">
            <div class="table-img" style="width: 400px; height: 400px; border-radius: 5px;">
                <img src="{{ $joueur?->photo->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/400x400' }}"
                    alt="">
            </div>

            <div class="player-infos" style="flex:1;">
                <table class="table-not-bootstrap" style="margin: 0">
                    <tbody>
                        @can('isAdmin')
                            <tr>
                                <th>User ID</th>
                                <td>{{ $joueur->user_id }}</td>
                            </tr>
                        @endcan
                        <tr>
                            <th>Nom</th>
                            <td>{{ $joueur->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Prénom</th>
                            <td>{{ $joueur->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Âge</th>
                            <td>{{ $joueur->age }}</td>
                        </tr>

                        @canany(['isCoach', 'isAdmin'])
                            <tr>
                                <th>Téléphone</th>
                                <td>{{ $joueur->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $joueur->email }}</td>
                            </tr>
                        @endcanany

                        <tr>
                            <th>Ville</th>
                            <td>{{ $joueur->city }}</td>
                        </tr>
                        <tr>
                            <th>Équipe</th>
                            <td>{{ $joueur->equipe?->name ?? 'Aucune' }}</td>
                        </tr>
                        <tr>
                            <th>Poste</th>
                            <td>{{ ucfirst($joueur->position?->name) ?? 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>{{ ucfirst($joueur->genre?->name) ?? 'Non défini' }}</td>
                        </tr>

                        @can('isAdmin')
                            <tr>
                                <th>Créé le</th>
                                <td>{{ $joueur->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Modifié le</th>
                                <td>{{ $joueur->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endcan
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
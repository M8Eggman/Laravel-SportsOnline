@extends('layouts.back')

@section('title', 'Détails de l’Équipe')

@section('content')
    <div class="page-team">

        <h1 class="table-title">Profil de l’équipe <span class="table-title-name">{{ $equipe->name }}</span></h1>

        <div class="table-header">
            <a href="{{ route('back.equipe.index') }}" class="btn-valo small">Retour</a>

            @can('update-equipe', $equipe)
                <a href="{{ route('back.equipe.edit', $equipe->id) }}" class="btn-valo small info">Modifier</a>
            @endcan
        </div>

        <div class="team-show-container" style="display:flex; gap:2rem;">
            <div class="table-img" style="width: 400px; height: 400px; border-radius: 0;">
                <img src="{{ $equipe?->src ? asset('storage/' . $equipe->src) : 'https://placehold.co/400x400' }}" alt="">
            </div>

            <div class="team-infos" style="flex:1;">
                <table class="table-not-bootstrap" style="margin:0">
                    <tbody>
                        @can('isAdmin')
                            <tr>
                                <th>ID</th>
                                <td>{{ $equipe->id }}</td>
                            </tr>
                            <tr>
                                <th>Créé par User</th>
                                <td>{{ $equipe->user->first_name }}</td>
                            </tr>
                        @endcan

                        <tr>
                            <th>Nom</th>
                            <td>{{ $equipe->name }}</td>
                        </tr>
                        <tr>
                            <th>Ville</th>
                            <td>{{ $equipe->city }}</td>
                        </tr>
                        <tr>
                            <th>Continent</th>
                            <td>{{ $equipe->continent?->name ?? 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>{{ ucfirst($equipe->genre?->name) ?? 'Non défini' }}</td>
                        </tr>

                        @can('isAdmin')
                            <tr>
                                <th>Créé le</th>
                                <td>{{ $equipe->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Modifié le</th>
                                <td>{{ $equipe->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endcan
                    </tbody>
                </table>
            </div>
        </div>
        @if($equipe->joueur && $equipe->joueur->count() > 0)
            <table class="table-not-bootstrap mt-4">
                <thead>
                    <tr class="separator">
                        <td colspan="2">Joueurs de l’équipe</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipe->joueur as $joueur)
                        <tr>
                            <td class="d-flex w-100 justify-content-between">
                                {{ $joueur->last_name }} {{ $joueur->first_name }}
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
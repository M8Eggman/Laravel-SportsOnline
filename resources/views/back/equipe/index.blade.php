@extends('layouts.back')

@section('title', 'Teams')

@section('content')
    <div class="container mt-4">
        <h1>Teams</h1>
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Liste des Équipes</h1>
                <a href="{{ route('back.equipe.create') }}" class="btn btn-primary">Créer une équipe</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom de l'équipe</th>
                            <th>Ville</th>
                            <th>Genre</th>
                            <th>Continent</th>
                            <th>Joueurs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipes as $equipe)
                            <tr>
                                <td>{{ $equipe->id }}</td>
                                <td>
                                    <strong>{{ $equipe->name }}</strong>
                                </td>
                                <td>{{ $equipe->city }}</td>
                                <td>
                                    @if($equipe->genre)
                                        <span class="badge bg-info">{{ $equipe->genre->name }}</span>
                                    @else
                                        <span class="text-muted">Non défini</span>
                                    @endif
                                </td>
                                <td>
                                    @if($equipe->continent)
                                        {{ $equipe->continent->name }}
                                    @else
                                        <span class="text-muted">Non défini</span>
                                    @endif
                                </td>
                                <td>
                                    @if($equipe->joueurs)
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($equipe->joueur as $joueur)
                                                <span class="badge bg-secondary small">{{ $joueur->first_name }}
                                                    {{ $joueur->last_name }}</span>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">({{ $equipe->joueurs->count() }} joueur(s))</small>
                                    @else
                                        <span class="text-muted">Aucun joueur</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('back.equipe.show', $equipe->id) }}"
                                            class="btn btn-sm btn-outline-info" title="Voir">
                                            Voir
                                        </a>
                                        <a href="{{ route('back.equipe.edit', $equipe->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Modifier">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('back.equipe.delete', $equipe->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Aucune équipe trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.back')

@section('title', 'Utilisateurs')

@section('content')
    <div class="container mt-4">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Liste des Utilisateurs</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Email vérifié</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) <= 0)
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Aucun utilisateur trouvé</td>
                            </tr>
                        @endif

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role)
                                        <span class="badge bg-info">{{ $user->role->name }}</span>
                                    @else
                                        <span class="text-muted">Aucun rôle</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Oui</span>
                                    @else
                                        <span class="badge bg-secondary">Non</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('back.user.show', $user->id) }}" class="btn btn-sm btn-outline-info"
                                            title="Voir">
                                            Voir
                                        </a>
                                        <a href="{{ route('back.user.edit', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Modifier">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('back.user.delete', $user->id) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer l\'utilisateur {{ $user->first_name }} {{ $user->last_name }} ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
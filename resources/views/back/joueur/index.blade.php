@extends('layouts.back')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Liste des joueurs</h2>
            <a href="{{ route('back.joueur.create') }}" class="btn btn-success">+ Créer un joueur</a>
        </div>
        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Équipe</th>
                    <th>Position</th>
                    <th>Âge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($joueurs) == 0)
                    <tr>
                        <td colspan="7" class="text-center">Aucun joueur trouvé</td>
                    </tr>
                @endif
                @foreach ($joueurs as $joueur)
                    <tr>
                        <td>{{ $joueur->id }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <img src="{{$joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}"
                                    class="rounded-circle object-fit-cover" style="max-width: 50px; max-height: 50px;">
                            </div>
                        </td>
                        <td>{{ $joueur->last_name }}</td>
                        <td>{{ $joueur->first_name }}</td>
                        <td>{{ $joueur->equipe->name ?? 'Sans équipe' }}</td>
                        <td>{{ ucfirst($joueur->position->name) ?? 'Sans positions' }}</td>
                        <td>{{ $joueur->age }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('back.joueur.delete', $joueur->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
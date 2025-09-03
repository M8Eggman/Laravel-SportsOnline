@extends('layouts.back')

@section('title', 'Players')

@section('content')
    <div class="page-team">
        <div class="table-header">
            <h2>Players List</h2>
            <a href="{{ route('back.joueur.create') }}" class="btn-valo">+ Create a Player</a>
        </div>

        @if(session('success'))
            <div class="alert-success-valo">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-not-bootstrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th style="width:15%;">Last Name</th>
                    <th style="width:15%;">First Name</th>
                    <th>Position</th>
                    <th>Team</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($mesJoueurs) > 0)
                    <tr class="separator">
                        <td colspan="8" class="text-center text-gray">My Players</td>
                    </tr>
                @endif

                @forelse($mesJoueurs as $joueur)
                    <tr>
                        <td>{{ $joueur->id }}</td>
                        <td>
                            <div class="table-img">
                                <img
                                    src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}">
                            </div>
                        </td>
                        <td>{{ $joueur->last_name }}</td>
                        <td>{{ $joueur->first_name }}</td>
                        <td>
                            @if($joueur->position)
                                <span class="badge info">{{ $joueur->position->name }}</span>
                            @else
                                <span class="text-gray">No Position</span>
                            @endif
                        </td>
                        <td>
                            @if($joueur->equipe)
                                <a href="{{ route('back.equipe.show', $joueur->equipe->id) }}" class="badge secondary">
                                    {{ $joueur->equipe->name }}
                                </a>
                            @else
                                <span class="text-gray">No Team</span>
                            @endif
                        </td>
                        <td>{{ $joueur->age }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">View</a>
                                @canany(['isAdmin', 'update-joueur'], $joueur)
                                    <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn-valo small warning">Edit</a>
                                    <form action="{{ route('back.joueur.delete', $joueur->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-valo small danger">Delete</button>
                                    </form>
                                @endcanany
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="table-empty">You have no players yet</td>
                    </tr>
                @endforelse

                @if(count($mesJoueurs) > 0)
                    <tr class="separator">
                        <td colspan="8" class="text-center text-gray">Other Players</td>
                    </tr>
                @endif

                @forelse($joueurs->whereNotIn('id', $mesJoueurs->pluck('id')) as $joueur)
                    <tr>
                        <td>{{ $joueur->id }}</td>
                        <td>
                            <div class="table-img">
                                <img
                                    src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}">
                            </div>
                        </td>
                        <td>{{ $joueur->last_name }}</td>
                        <td>{{ $joueur->first_name }}</td>
                        <td>
                            @if($joueur->position)
                                <span class="badge info">{{ $joueur->position->name }}</span>
                            @else
                                <span class="text-gray">No Position</span>
                            @endif
                        </td>
                        <td>
                            @if($joueur->equipe)
                                <a href="{{ route('back.equipe.show', $joueur->equipe->id) }}" class="badge secondary">
                                    {{ $joueur->equipe->name }}
                                </a>
                            @else
                                <span class="text-gray">No Team</span>
                            @endif
                        </td>
                        <td>{{ $joueur->age }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">View</a>
                                @canany(['isAdmin', 'update-joueur'], $joueur)
                                    <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn-valo small warning">Edit</a>
                                    <form action="{{ route('back.joueur.delete', $joueur->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-valo small danger">Delete</button>
                                    </form>
                                @endcanany
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="table-empty">No other players found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
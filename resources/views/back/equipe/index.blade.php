@extends('layouts.back')

@section('title', 'Teams')

@section('content')
    <div class="page-team">
        <h1 class="table-title">Teams</h1>

        <div class="table-header">
            <h2>Teams List</h2>
            <a href="{{ route('back.equipe.create') }}" class="btn-valo">Create a Team</a>
        </div>

        @if(session('success'))
            <div class="alert-success-valo">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-not-bootstrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th style="width: 15%">Team Name</th>
                    <th style="width: 10%;">City</th>
                    <th>Gender</th>
                    <th>Continent</th>
                    <th>Players</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($mesEquipes) > 0)
                    <tr class="separator">
                        <td colspan="8" class="text-center text-gray">My Teams</td>
                    </tr>
                @endif

                @forelse($mesEquipes as $equipe)
                    <tr>
                        <td>{{ $equipe->id }}</td>
                        <td>
                            <div class="table-img">
                                <img src="{{ $equipe?->src ? asset('storage/' . $equipe->src) : 'https://placehold.co/50x50' }}"
                                    alt="Team Photo">
                            </div>
                        </td>
                        <td class="break"><strong>{{ $equipe->name }}</strong></td>
                        <td class="break">{{ $equipe->city }}</td>
                        <td>
                            @if($equipe->genre?->name === 'male')
                                <span class="badge info">Male Team</span>
                            @elseif($equipe->genre?->name === 'female')
                                <span class="badge info">Female Team</span>
                            @else
                                <span class="badge info">Mixed Team</span>
                            @endif
                        </td>
                        <td>
                            @if($equipe->continent)
                                {{ $equipe->continent->name }}
                            @else
                                <span class="text-gray">Not Defined</span>
                            @endif
                        </td>
                        <td>
                            @if(count($equipe->joueur) > 0)
                                <div class="table-items">
                                    @foreach($equipe->joueur as $joueur)
                                        <a class="badge secondary" href="{{ route('back.joueur.show', $joueur->id) }}">
                                            {{ $joueur->first_name }} {{ $joueur->last_name }}
                                        </a>
                                    @endforeach
                                </div>
                                <span class="text-gray small">{{ count($equipe->joueur) }} / 7 player(s)</span>
                            @else
                                <span class="text-gray">No players</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('back.equipe.show', $equipe->id) }}" class="btn-valo small info">View</a>
                                @canany(['isAdmin', 'update-equipe'], $equipe)
                                    <a href="{{ route('back.equipe.edit', $equipe->id) }}" class="btn-valo small warning">Edit</a>
                                    <form method="POST" action="{{ route('back.equipe.delete', $equipe->id) }}">
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
                        <td colspan="8" class="table-empty">You have no teams yet</td>
                    </tr>
                @endforelse

                @if(count($mesEquipes) > 0)
                    <tr class="separator">
                        <td colspan="8" class="text-center text-gray">Other Teams</td>
                    </tr>
                @endif

                @forelse($equipes->whereNotIn('id', $mesEquipes->pluck('id')) as $equipe)
                    <tr>
                        <td>{{ $equipe->id }}</td>
                        <td>
                            <div class="table-img">
                                <img src="{{ $equipe?->src ? asset('storage/' . $equipe->src) : 'https://placehold.co/50x50' }}"
                                    alt="Team Photo">
                            </div>
                        </td>
                        <td class="break"><strong>{{ $equipe->name }}</strong></td>
                        <td class="break">{{ $equipe->city }}</td>
                        <td>
                            @if($equipe->genre?->name === 'male')
                                <span class="badge info">Male Team</span>
                            @elseif($equipe->genre?->name === 'female')
                                <span class="badge info">Female Team</span>
                            @else
                                <span class="badge info">Mixed Team</span>
                            @endif
                        </td>
                        <td>
                            @if($equipe->continent)
                                {{ $equipe->continent->name }}
                            @else
                                <span class="text-gray">Not Defined</span>
                            @endif
                        </td>
                        <td>
                            @if(count($equipe->joueur) > 0)
                                <div class="table-items">
                                    @foreach($equipe->joueur as $joueur)
                                        <a class="badge secondary" href="{{ route('back.joueur.show', $joueur->id) }}">
                                            {{ $joueur->first_name }} {{ $joueur->last_name }}
                                        </a>
                                    @endforeach
                                </div>
                                <span class="text-gray small">{{ count($equipe->joueur) }} / 7 player(s)</span>
                            @else
                                <span class="text-gray">No players</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('back.equipe.show', $equipe->id) }}" class="btn-valo small info">View</a>
                                @canany(['isAdmin', 'update-equipe'], $equipe)
                                    <a href="{{ route('back.equipe.edit', $equipe->id) }}" class="btn-valo small warning">Edit</a>
                                    <form method="POST" action="{{ route('back.equipe.delete', $equipe->id) }}">
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
                        <td colspan="8" class="table-empty">No other teams found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
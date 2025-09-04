@extends('layouts.front')

@section('title', $joueur->first_name . ' ' . $joueur->last_name)

@section('content')
    <div class="container p-5">
        <div class="card_div card border-0">
            <div class="div_player d-flex g-3">
                <div class="div_player_ni">
                    <div class="d-flex justify-content-center player_img">
                        <img src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/300' }}" alt="">
                    </div>
                    <h2 class="card-title player_name">{{ $joueur->first_name }} {{ $joueur->last_name }}</h2>

                </div>
                <div class="div_back flex-grow-1">
                    <div class="card-body d-flex flex-column h-100">
                        <div class="div_back_info">
                            <p><strong>Age:</strong> {{ $joueur->age ?? 'N/A' }}</p>
                            <p><strong>Position:</strong> {{ ucfirst($joueur->position?->name) ?? 'Not specified' }}</p>
                            <p><strong>City:</strong> {{ $joueur->city ?? 'Unknown' }}</p>

                            @canany(['isAdmin', 'isCoach'])
                                <p><strong>Email:</strong> {{ $joueur->email }}</p>
                                <p><strong>Phone:</strong> {{ $joueur->phone }}</p>
                            @endcanany
                            <p>
                                <strong style="color: red">Team:</strong>
                                @if($joueur->equipe)
                                    <a href="{{ route('equipe.show', $joueur->equipe->id) }}" class="text-decoration-none">
                                        {{ $joueur->equipe->name }}
                                    </a>
                                @else
                                    <span class="text-muted">No team</span>
                                @endif
                            </p>
                            <p><strong>Gender:</strong>
                                @if ($joueur->genre?->name == 'male')
                                    Male
                                @elseif ($joueur->genre?->name == 'female')
                                    Female
                                @else
                                    Not specified
                                @endif
                            </p>
                        </div>

                        <div class="div_edit mt-3">
                            <a onclick="history.back();" class="btn btn-secondary">Back</a>
                            @canany(['isAdmin', 'update-joueur'], $joueur)
                                <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn btn-warning">Edit Player</a>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.front')

@section('title', $joueur->first_name . ' ' . $joueur->last_name)

@section('content')
    <div class="container p-5">
        <div class="card border-0">
            <div class="d-flex g-3">
                <div class="d-flex justify-content-center" style="max-width: 300px;">
                    <img src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/300' }}"
                        class="img-fluid" alt="">
                </div>
                <div class="flex-grow-1">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h2 class="card-title">{{ $joueur->first_name }} {{ $joueur->last_name }}</h2>
                            <p><strong>Age:</strong> {{ $joueur->age ?? 'N/A' }}</p>
                            <p><strong>Position:</strong> {{ ucfirst($joueur->position?->name) ?? 'Not specified' }}</p>
                            <p><strong>City:</strong> {{ $joueur->city ?? 'Unknown' }}</p>

                            @canany(['isAdmin', 'isCoach'])
                                <p><strong>Email:</strong> {{ $joueur->email }}</p>
                                <p><strong>Phone:</strong> {{ $joueur->phone }}</p>
                            @endcanany
                            <p>
                                <strong>Team:</strong>
                                @if($joueur->equipe)
                                    <a href="{{ route('equipe.show', $joueur->equipe->id) }}" class="text-decoration-none">
                                        {{ $joueur->equipe->name }}
                                    </a>
                                @else
                                    <span class="text-muted">No team</span>
                                @endif
                            </p>
                            <p><strong>Gender:</strong>
                                @if ($joueur->genre?->name == 'masculin')
                                    Male
                                @elseif ($joueur->genre?->name == 'feminin')
                                    Female
                                @else
                                    Not specified
                                @endif
                            </p>
                        </div>

                        <div class="mt-3">
                            <a onclick="history.back();" class="btn btn-secondary">Back</a>
                            @canany(['isAdmin', 'isCoach'])
                                <a href="{{ route('back.joueur.edit', $joueur->id) }}" class="btn btn-warning">Edit Player</a>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
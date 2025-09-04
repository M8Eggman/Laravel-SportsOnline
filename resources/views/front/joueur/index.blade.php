@extends('layouts.front')

@section('title', 'Players')

@section('content')
    <div class="container players mt-4">
        <h1 class="mb-4 titre_home"> Our Players</h1>

        <div class="row">
            @forelse($joueurs as $joueur)
                <div class="col-md-4 mb-4">
<<<<<<< HEAD
                    <x-card :title="$joueur->first_name . ' ' . $joueur->last_name" :subtitle="'Position: ' . ucfirst($joueur->position->name)" 
                        :image="$joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : null" :link="route('joueur.show', $joueur->id)" :element="$joueur" />
=======
                    <div class="card h-100 shadow-sm border-0">
                        @if($joueur->photo && $joueur->photo->src)
                            <img src="{{ asset('storage/' . $joueur->photo->src) }}" class="card-img-top" alt="">
                        @else
                            <img src="https://placehold.co/400" class="card-img-top" alt="">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title">
                                {{ $joueur->first_name }} {{ $joueur->last_name }}
                            </h5>
                            <p class="card-text text-muted mb-2">
                                {{ ucfirst($joueur->position?->name) ?? 'No position specified' }}
                            </p>
                            <p class="card-text text-muted mb-2">
                                {{ ucfirst($joueur->genre?->name) ?? 'No genre specified' }}
                            </p>
                            <p class="card-text small text-secondary">
                                {{ $joueur->city ?? 'Unknown city' }}
                            </p>
                            <a href="{{ route('joueur.show', $joueur->id) }}" class="btn btn-outline-primary btn-sm">
                                View Profile
                            </a>
                        </div>

                        <div class="card-footer text-muted text-center small">
                            Age: {{ $joueur->age ?? 'N/A' }}
                        </div>
                    </div>
>>>>>>> 37d206167db2aa86a60036aeddd5d05721f6d62b
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No players found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
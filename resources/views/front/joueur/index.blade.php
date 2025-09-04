@extends('layouts.front')

@section('title', 'Players')

@section('content')
    <div class="container players mt-4">
        <h1 class="mb-4 titre_home"> Our Players</h1>

        <div class="row">
            @forelse($joueurs as $joueur)
                <div class="col-md-4 mb-4">
                    <x-card :title="$joueur->first_name . ' ' . $joueur->last_name" :subtitle="'Position: ' . ucfirst($joueur->position->name)" 
                        :image="$joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : null" :link="route('joueur.show', $joueur->id)" :element="$joueur" />
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
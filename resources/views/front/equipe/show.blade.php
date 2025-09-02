@extends('layouts.front')

@section('title', $equipe->name)

@section('content')
    <div class="container p-5">
        <div class="card border-0">
            <div class="d-flex g-3">
                <div class="d-flex justify-content-center" style="max-width: 300px;">
                    <img src="{{ $equipe->url ? $equipe->url : 'https://placehold.co/300' }}" class="img-fluid" alt="">
                </div>
                <div>
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <div>
                            <h2 class="card-title">{{ $equipe->name }}</h2>
                            <p><strong>City:</strong> {{ $equipe->city }}</p>
                            <p><strong>Continent:</strong> {{ $equipe->continent?->name ?? 'Not specified' }}</p>
                            <p>
                                <strong>Type:</strong>
                                @if($equipe->genre?->name == 'masculin')
                                    Masculine
                                @elseif($equipe->genre?->name == 'feminin')
                                    Feminine
                                @else
                                    Mixed
                                @endif
                            </p>
                            @canany(['isAdmin', 'isCoach'])
                                <p>
                                    <strong>Created by:</strong>
                                    {{ $equipe->user?->first_name }} {{ $equipe->user?->last_name  }}
                                </p>
                            @endcanany
                            <div class="d-flex flex-wrap gap-2">
                                <p><strong>Players ({{ $equipe->joueur->count() }}):</strong></p>
                                @if($equipe->joueur->count() > 0)
                                    @foreach($equipe->joueur as $joueur)
                                        <a href="{{ route('joueur.show', $joueur->id) }}" class="text-black text-decoration-none">
                                            {{ $joueur->first_name }} {{ $joueur->last_name }}
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a onclick="history.back();" class="btn btn-secondary">Back</a>
                            @canany(['isAdmin', 'isCoach'])
                                <a href="{{ route('back.equipe.edit', $equipe->id) }}" class="btn btn-warning">Edit Team</a>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
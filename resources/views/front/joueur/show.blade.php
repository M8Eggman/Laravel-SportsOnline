@extends('layouts.front')

@section('title', $joueur->first_name . ' ' . $joueur->last_name)

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-4">
                    <a href="{{ route('joueur.index') }}" class="btn btn-secondary">← Back to Players</a>
                </div>
                <div class="card border-0">
                    <div class="row g-0">
                        <div class="col-4">
                            @if($joueur->photo && $joueur->photo->src)
                                <img src="{{ asset('storage/' . $joueur->photo->src) }}" class="img-fluid rounded-start" alt="">
                            @else
                                <img src="https://placehold.co/400x400" class="img-fluid rounded-start" alt="">
                            @endif
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $joueur->first_name }} {{ $joueur->last_name }}
                                </h2>

                                <ul class="list-group list-group-flush mt-3">
                                    <li class="list-group-item">
                                        <strong>Age:</strong> {{ $joueur->age ?? 'N/A' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Position:</strong> {{ $joueur->position?->name ?? 'Not specified' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>City:</strong> {{ $joueur->city ?? 'Unknown' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> {{ $joueur->email ?? 'Not provided' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Phone:</strong> {{ $joueur->phone ?? 'Not provided' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Team:</strong>
                                        @if($joueur->equipe)
                                            <a href="{{ route('equipe.show', $joueur->equipe->id) }}">
                                                {{ $joueur->equipe->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">No team</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Gender:</strong> {{ $joueur->genre?->name ?? 'Not specified' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
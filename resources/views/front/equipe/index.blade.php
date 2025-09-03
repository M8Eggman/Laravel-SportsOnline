@extends('layouts.front')

@section('title', 'Teams')

@section('content')
    <div class="container mt-4">
        <h1>Our Teams</h1>

        <div class="row">
            @foreach($equipes as $equipe)
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $equipe->name }}</h3>
                            <p>{{ $equipe->city }}</p>
                            @if($equipe->genre)
                                <span class="badge badge-primary">{{ ucfirst($equipe->genre->name) }}</span>
                            @endif
                        </div>

                        <div class="card-body">
                            @if($equipe->joueur && $equipe->joueur->count() > 0)
                                <div class="row">
                                    @foreach ($equipe->joueur as $joueur)
                                        <div class="col-md-6 mb-3">
                                            @if($joueur->photo && $joueur->photo->src)
                                                <img src="{{ Storage::url($joueur->photo->src) }}" 
                                                     alt="{{ $joueur->first_name }}" 
                                                     class="rounded-circle mb-2" 
                                                     width="60" height="60">
                                            @endif
                                            
                                            <h6>{{ $joueur->first_name }} {{ $joueur->last_name }}</h6>
                                            
                                            @if($joueur->position)
                                                <small class="text-muted">{{ $joueur->position->name }}</small><br>
                                            @endif
                                            
                                            <small>{{ $joueur->age }} ans</small>
                                            @if($joueur->city)
                                                <small> - {{ $joueur->city }}</small>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Aucun joueur dans cette équipe</p>
                            @endif
                        </div>

                        <div class="card-footer text-muted">
                            <small>{{ $equipe->joueur->count() }} joueurs</small>
                            @if($equipe->continent)
                                <small> - {{ $equipe->continent->name }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
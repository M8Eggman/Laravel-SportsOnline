@extends('layouts.front')

@section('title', 'Players')

@section('content')
<div class="container mt-4">
    <h1>Players</h1>
    
    <div class="row">
        @foreach($joueurs as $joueur)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $joueur->nom }}</h5>
                    <p class="card-text">{{ $joueur->poste ?? 'Poste non spécifié' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
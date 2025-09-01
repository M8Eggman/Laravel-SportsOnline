@extends('layouts.front')

@section('title', 'Teams')

@section('content')
<div class="container mt-4">
    <h1>Teams</h1>
    
    <div class="row">
        @foreach($equipes as $equipe)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $equipe->nom }}</h5>
                    <p class="card-text">{{ $equipe->description ?? 'Description non disponible' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
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
                    <h5 class="card-title">{{ $equipe->name }}</h5>
                    @if($equipe->joueur)
                    @foreach ($equipe->joueur as $j )
                    
                    <p class="card-text">{{ $j->last_name }}</p>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <a href="{{ route('equipe.index') }}">Administration des équipes</a>
    </div>
</div>
@endsection
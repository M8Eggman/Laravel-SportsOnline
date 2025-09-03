@extends('layouts.front')

@section('title', 'Teams')

@section('content')
    <div class="container mt-4">
        <h1 class="titre_home">Our Teams</h1>
       @foreach($equipes as $equipe)
           <div class="team ">
               <h2>{{ $equipe->name }}</h2>
               <p>{{ $equipe->city }}</p>
               @if($equipe->genre)
                   <span>{{ ucfirst($equipe->genre->name) }}</span>
               @endif

               @if($equipe->joueur && $equipe->joueur->count() > 0)
                   @foreach ($equipe->joueur as $joueur)
                       <div class="team_player">
                        <div class="team_img">
                            @if($joueur->photo && $joueur->photo->src)
                            <img src="{{ Storage::url($joueur->photo->src) }}" alt="{{ $joueur->first_name }}" >
                            @endif
                            <h3>{{ $joueur->first_name }} {{ $joueur->last_name }}</h3>

                        </div>
                           <div class="player_info">
                                @if($joueur->position)
                                <p><small>Position:</small> {{ $joueur->position->name }}</p>
                                @endif
                                <p><small>Age:</small> {{ $joueur->age }} ans</p>
                                <p><small>Ville:</small> {{ $joueur->city }}</p>
                                @if($joueur->genre)
                                <p><small>Genre:</small> {{ $joueur->genre->name }}</p>
                                @endif
                                @if($joueur->equipe)
                                <p><small>Continent:</small> {{ $joueur->equipe->continent->name }}</p>
                                @endif
                           </div>

                       </div>
                   @endforeach
               @else
                   <p>Aucun joueur dans cette équipe</p>
               @endif

               <p>{{ $equipe->joueur->count() }} joueurs</p>
               @if($equipe->continent)
                   <p>{{ $equipe->continent->name }}</p>
               @endif
           </div>
           <hr>
       @endforeach
   </div>
@endsection
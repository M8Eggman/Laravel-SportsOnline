@extends('layouts.front')

@section('title', 'Teams')

@section('content')
    <div class="container mt-4">
        <h1 class="titre_home">Our Teams</h1>
       @foreach($equipes as $equipe)
           <div class="team ">
               <h2>{{ $equipe->name }}</h2>
               <div class="team_city">
                   <p class="city">{{ $equipe->city }}</p>
                   @if($equipe->genre)
                       <span class="equipe_genre">{{ ucfirst($equipe->genre->name) }}</span>
                   @endif
               </div>


               <div class="equipe_glo">

                   @if($equipe->joueur && $equipe->joueur->count() > 0)
                       @foreach ($equipe->joueur as $joueur)
                        <div class="team_players col-md-3">
                            <x-card :title="$joueur->last_name.' '.$joueur->first_name" :subtitle="$joueur->position->name" :image="$joueur?->photo->src ? asset('storage/' . $joueur->photo->src) : null"
                                :link="route('equipe.show', $joueur->id)" :element="$joueur" />
                        </div>
                        @endforeach
                   @else
                       <p>Aucun joueur dans cette équipe</p>
                   @endif

               </div>    
           </div>
           <hr>
       @endforeach
   </div>
@endsection
@extends('layouts.front')

@section('title', $equipe->name)


@section('content')
    <div class="container mt-4">
           <div class="team_one">
                <div class="div_team_img">
                    <img src="{{ Storage::url($equipe->src) }}" alt="">
                </div>
                <h2>{{ $equipe->name }}</h2>
               <h4>{{ $equipe->city }}</h4>
               <div class="div_team_titre">
                    @if($equipe->genre)
                    <span class="spanee">Equipe {{ ucfirst($equipe->genre->name) }}e</span>
                    @endif
                    @if($equipe->continent)
                    <p class="team_conti">{{ $equipe->continent->name }}</p>
                    @endif
               </div>

                <div class="div_team_players">
                @if($equipe->joueur && $equipe->joueur->count() > 0)
                    @foreach ($equipe->joueur as $joueur)
                            <div class="team_player_one">
                                <div class="team_img_one">
                                    @if($joueur->photo && $joueur->photo->src)
                                    <img src="{{ Storage::url($joueur->photo->src) }}" alt="{{ $joueur->first_name }}" >
                                    @endif
                                    <div>
                                        <h4><span class="spane">{{ $joueur->last_name }}</span> {{ $joueur->first_name }}</h4>
                                        @if($joueur->position)
                                        <p><small>Position:</small><span style="text-transform:uppercase"> {{ $joueur->position->name }}</span></p>
                                        @endif
                                    </div>
                                </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucun joueur dans cette équipe</p>
                @endif

               </div>
               <div class="div_count">
                    <p class="spanee">{{ $equipe->joueur->count() }} joueurs</p>

               </div>

           </div>
   </div>
@endsection
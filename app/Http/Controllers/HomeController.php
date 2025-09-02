<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // toutes les équipes d’europe
        $europeTeams = Equipe::whereHas('continent', function ($q) {
            $q->where('name', 'Europe');
        })->get();

        // 8 joueurs d’équipes européennes
        $europePlayers = Joueur::whereHas('equipe.continent', function ($q) {
            $q->where('name', 'Europe');
        })->take(8)->get();

        // 4 équipes hors europe
        $notEuropeTeams = Equipe::whereHas('continent', function ($q) {
            $q->where('name', '!=', 'Europe');
        })->take(4)->get();

        // 8 joueurs hors europe
        $notEuropePlayers = Joueur::whereHas('equipe.continent', function ($q) {
            $q->where('name', '!=', 'Europe');
        })->take(8)->get();

        // 4 joueurs sans équipe
        $freePlayers = Joueur::whereNull('equipe_id')->take(4)->get();

        return view('accueil', compact('europeTeams', 'europePlayers', 'notEuropeTeams', 'notEuropePlayers', 'freePlayers'));
    }
}

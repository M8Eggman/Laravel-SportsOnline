<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Continent;
use App\Models\Joueur;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_front()
    {
        $equipes = Equipe::with(['genre', 'continent', 'joueur'])->get();
        return view('front.equipe.index', compact('equipes'));
    }
    public function index(){

        $equipes = Equipe::with(['genre', 'continent', 'joueur'])->get();
        $genres = Genre::all();
        $continents = Continent::all();
        $joueurs = Joueur::all();
        return view('back.equipe.index', compact('equipes'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipe = Equipe::with(['genre', 'continent', 'joueur'])->findOrFail($id);
        return view('front.equipe.show', compact('equipe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $continents = Continent::all();
        return view('back.equipe.create', compact('genres', 'continents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'continent_id' => 'nullable|exists:continents,id',
        ]);

        Equipe::create([
            'name' => $request->name,
            'city' => $request->city,
            'genre_id' => $request->genre_id,
            'continent_id' => $request->continent_id,
        ]);

        return redirect()->route('equipe.index')->with('success', 'Équipe ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipe = Equipe::findOrFail($id);
        $genres = Genre::all();
        $continents = Continent::all();
        $joueurs = Joueur::where('equipe_id', $id)->get();
        
        return view('back.equipe.edit', compact('equipe', 'genres', 'continents', 'joueurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'continent_id' => 'nullable|exists:continents,id',
        ]);

        $equipe = Equipe::findOrFail($id);
        $equipe->update([
            'name' => $request->name,
            'city' => $request->city,
            'genre_id' => $request->genre_id,
            'continent_id' => $request->continent_id,
        ]);

        return redirect()->route('equipe.index')->with('success', 'Équipe mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipe = Equipe::findOrFail($id);
        $equipe->delete();
        return redirect()->route('equipe.index')->with('success', 'Équipe supprimée avec succès!');
    }
}
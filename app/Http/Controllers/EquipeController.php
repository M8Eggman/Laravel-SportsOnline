<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipeRequest;
use App\Http\Requests\UpdateEquipeRequest;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Continent;
use App\Models\Joueur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_masculin()
    {
        $equipes = Equipe::whereHas('genre', fn($q) => $q->where('name', 'Masculin'))->get();

        return view('front.equipe.index', compact('equipes'));
    }

    public function index_feminin()
    {
        $equipes = Equipe::whereHas('genre', fn($q) => $q->where('name', 'Feminin'))->get();

        return view('front.equipe.index', compact('equipes'));
    }

    public function index_mixte()
    {
        $equipes = Equipe::whereNull('genre_id')->get();

        return view('front.equipe.index', compact('equipes'));
    }

    public function index_back()
    {
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

    public function show_back($id)
    {
        $equipe = Equipe::with(['genre', 'continent', 'joueur'])->findOrFail($id);
        return view('back.equipe.show', compact('equipe'));
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
    public function store(StoreEquipeRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'url' => 'nullable|string',
            'genre_id' => 'nullable|exists:genres,id',
            'continent_id' => 'nullable|exists:continents,id',
        ]);

        $equipe = new Equipe();
        $equipe->name = $request->name;
        $equipe->city = $request->city;
        $equipe->url = $request->url;
        $equipe->genre_id = $request->genre_id;
        $equipe->user_id = $request->user()->id;
        $equipe->continent_id = $request->continent_id;

        $equipe->save();

        return redirect()->route('back.equipe.index')->with('success', 'Équipe ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipe = Equipe::findOrFail($id);

        if (!Gate::allows('update-equipe', $equipe)) {
            return redirect('/');
        }

        $genres = Genre::all();
        $continents = Continent::all();
        $joueurs = Joueur::where('equipe_id', $id)->get();

        return view('back.equipe.edit', compact('equipe', 'genres', 'continents', 'joueurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipeRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'url' => 'nullable|string',
            'genre_id' => 'nullable|exists:genres,id',
            'continent_id' => 'nullable|exists:continents,id',
        ]);

        $equipe = Equipe::findOrFail($id);

        if (!Gate::allows('update-equipe', $equipe)) {
            return redirect('/');
        }

        $equipe->name = $request->name;
        $equipe->city = $request->city;
        $equipe->url = $request->url;
        $equipe->genre_id = $request->genre_id;
        $equipe->user_id = $request->user()->id;
        $equipe->continent_id = $request->continent_id;

        $equipe->save();

        return redirect()->route('back.equipe.index')->with('success', 'Équipe mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipe = Equipe::findOrFail($id);

        if (!Gate::allows('update-equipe', $equipe)) {
            return redirect('/');
        }

        $equipe->delete();
        return redirect()->route('back.equipe.index')->with('success', 'Équipe supprimée avec succès!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Http\Requests\StoreJoueurRequest;
use App\Http\Requests\UpdateJoueurRequest;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joueurs = Joueur::all();
        return view('joueur.index', compact('joueurs'));
    }
    
    public function show($id)
    {
        $joueur = Joueur::findOrFail($id);
        return view('joueur.show', compact('joueur'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJoueurRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Joueur $joueur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJoueurRequest $request, Joueur $joueur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
        //
    }
}

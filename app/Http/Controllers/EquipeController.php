<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipeRequest;
use App\Http\Requests\UpdateEquipeRequest;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Continent;
use App\Models\Joueur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Str;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($continent)
    {
        $equipes = match ($continent) {
            'See All' => Equipe::all(),
            default => Equipe::whereHas('continent', function ($q) use ($continent) {
                    $q->where('name', $continent);
                })->orWhereNull('continent_id')->get(),
        };

        return view('front.equipe.index', compact('equipes'));
    }

    public function index_back()
    {
        $equipes = Equipe::with(['genre', 'continent', 'joueur'])->get();
        $mesEquipes = Equipe::where('user_id', Auth::id())->get();
        return view('back.equipe.index', compact('equipes', "mesEquipes"));
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
            'name' => ['required', 'string', 'max:25'],
            'city' => ['required', 'string', 'max:100'],
            'src' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'genre_id' => ['nullable', 'exists:genres,id'],
            'continent_id' => ['required', 'exists:continents,id'],
        ]);

        $equipe = new Equipe();
        $equipe->name = $request->name;
        $equipe->city = $request->city;
        $equipe->genre_id = $request->genre_id;
        $equipe->user_id = $request->user()->id;
        $equipe->continent_id = $request->continent_id;

        if ($request->hasFile('src')) {
            $file = $request->file('src');

            // nom du fichier url friendly + date + unique
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = date('Y_m_d_His') . '_' . uniqid() . '_' . Str::slug($original_name) . '.' . $file->getClientOriginalExtension();

            // stock l'image dans public/photo_joueur
            $file_path = $file->storeAs('photo_equipe', $file_name, 'public');

            $equipe->src = $file_path;
        }

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
            'name' => ['required', 'string', 'max:25'],
            'city' => ['required', 'string', 'max:50'],
            'src' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'genre_id' => ['nullable', 'exists:genres,id'],
        ]);

        $equipe = Equipe::findOrFail($id);

        if (!Gate::allows('update-equipe', $equipe)) {
            return redirect('/');
        }

        $equipe->name = $request->name;
        $equipe->city = $request->city;
        $equipe->user_id = $request->user()->id;
        $equipe->continent_id = $request->continent_id;

        if ($request->hasFile('src')) {
            $file = $request->file('src');

            // nom du fichier url friendly + date + unique
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = date('Y_m_d_His') . '_' . uniqid() . '_' . Str::slug($original_name) . '.' . $file->getClientOriginalExtension();

            // stock l'image dans public/photo_equipe
            $file_path = $file->storeAs('photo_equipe', $file_name, 'public');

            // supprimer l’ancienne image si elle existe
            if ($equipe->src) {
                // vérifie que le fichier est bien dans photo_equipe avant de le supprimer sinon ça supprimait l'image utilisé par le seeder
                if (Str::startsWith($equipe->src, 'photo_equipe/')) {
                    Storage::disk('public')->delete($equipe->src);
                }
            }

            $equipe->src = $file_path;
        }

        $equipe->save();

        return redirect()->route('back.equipe.show', $equipe->id)->with('success', 'Équipe mise à jour avec succès');
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
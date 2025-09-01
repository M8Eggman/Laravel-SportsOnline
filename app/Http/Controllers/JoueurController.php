<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Http\Requests\StoreJoueurRequest;
use App\Http\Requests\UpdateJoueurRequest;
use App\Models\Photo;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Str;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joueurs = Joueur::all();
        return view('front.joueur.index', compact('joueurs'));
    }
    public function index_back()
    {
        $joueurs = Joueur::all();
        return view('back.joueur.index', compact('joueurs'));
    }
    public function show($id)
    {
        $joueur = Joueur::findOrFail($id);
        return view('back.joueur.show', compact('joueur'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $equipes = Equipe::all();
        $genres = Genre::all();
        return view('back.joueur.create', compact('positions', 'equipes', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJoueurRequest $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:16', 'max:60'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', 'unique:joueurs,email'],
            'city' => ['nullable', 'string', 'max:255'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'equipe_id' => ['nullable', 'integer', 'exists:equipes,id'],
            'genre_id' => ['nullable', 'integer', 'exists:genres,id'],
            'src' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $joueur = new Joueur();
        $joueur->first_name = $request->first_name;
        $joueur->last_name = $request->last_name;
        $joueur->age = $request->age;
        $joueur->phone = $request->phone;
        $joueur->email = $request->email;
        $joueur->city = $request->city;
        $joueur->position_id = $request->position_id;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->genre_id = $request->genre_id;
        $joueur->user_id = Auth::id() ?? null;

        $joueur->save();

        $photo = new Photo();
        $photo->joueur_id = $joueur->id;

        if ($request->hasFile('src')) {
            $file = $request->file('src');

            // nom du fichier url friendly + date + unique
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = date('Y_m_d_His') . '_' . uniqid() . '_' . Str::slug($original_name) . '.' . $file->getClientOriginalExtension();

            // stock l'image dans public/photo_joueur
            $file_path = $file->storeAs('photo_joueur', $file_name, 'public');

            $photo->src = $file_path;
        }

        $photo->save();

        return redirect()->route('back.joueur.index')->with('success', 'Joueur créé !');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $joueur = Joueur::findOrFail($id);
        $positions = Position::all();
        $equipes = Equipe::all();
        $genres = Genre::all();
        return view('back.joueur.edit', compact('joueur', 'positions', 'equipes', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJoueurRequest $request, $id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:16', 'max:60'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'equipe_id' => ['nullable', 'integer', 'exists:equipes,id'],
            'src' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $joueur = Joueur::findOrFail($id);
        $joueur->first_name = $request->first_name;
        $joueur->last_name = $request->last_name;
        $joueur->age = $request->age;
        $joueur->position_id = $request->position_id;
        $joueur->equipe_id = $request->equipe_id;

        $joueur->save();

        $photo = Photo::where('joueur_id', $joueur->id)->first();

        if ($request->hasFile('src')) {
            $file = $request->file('src');

            // nom du fichier url friendly + date + unique
            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = date('Y_m_d_His') . '_' . uniqid() . '_' . Str::slug($original_name) . '.' . $file->getClientOriginalExtension();

            // stock l'image dans public/photo_joueur
            $file_path = $file->storeAs('photo_joueur', $file_name, 'public');

            // supprimer l’ancienne image si elle existe
            if ($joueur->photo && $joueur->photo?->src) {
                // vérifie que le fichier est bien dans photo_joueur avant de le supprimer sinon ça supprimait l'image utilisé par le seeder
                if (Str::startsWith($joueur->photo->src, 'photo_joueur/')) {
                    Storage::disk('public')->delete($joueur->photo->src);
                }
            }

            $photo->src = $file_path;
        }

        $photo->save();


        return redirect()->route('back.joueur.index')->with('success', 'Joueur mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $joueur = Joueur::findOrFail($id);
        $joueur->delete();

        return redirect()->route('back.joueur.index')->with('success', 'Joueur supprimé !');
    }
}

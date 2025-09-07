<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index_back()
    {
        $users = User::all();
        return view('back.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('back.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('back.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $user = User::findOrFail($id);

        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        // si l'user est lui meme ne peux pas modifié son role
        if ($request->user()->id !== $user->id) {
            $user->role_id = $request->role_id;
        }

        $user->save();

        return redirect()->route('back.user.index')->with('success', 'Utilisateur mis à jour !');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $currentUser = auth()->user();


        // empêche qu'un admin se supprime lui-même
        if ($user->id === $currentUser->id) {
            return redirect()
                ->route('back.user.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        // empêche de supprimer le dernier admin
        if ($user->role->name === 'admin') {
            $adminCount = User::whereHas('role', fn($q) => $q->where('name', 'admin'))->count();
            if ($adminCount <= 1) {
                return redirect()
                    ->route('back.user.index')
                    ->with('error', 'Impossible de supprimer le dernier admin !');
            }
        }

        $user->delete();

        return redirect()->route('back.user.index')->with('success', 'Utilisateur supprimé !');
    }
}

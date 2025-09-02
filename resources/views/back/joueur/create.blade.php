@extends('layouts.back')

@section('content')
    <div class="container my-5">
        <h2>Créer un joueur</h2>
        <form action="{{ route('back.joueur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- First Name --}}
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}"
                    required>
                @error('first_name')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Last Name --}}
            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}"
                    required>
                @error('last_name')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Age --}}
            <div class="mb-3">
                <label for="age" class="form-label">Âge</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required>
                @error('age')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Genre --}}
            <div class="mb-3">
                <label for="genre_id" class="form-label">Genre</label>
                <select name="genre_id" id="genre_id" class="form-select">
                    <option value="">Autre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ ucfirst($genre->name) }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- City --}}
            <div class="mb-3">
                <label for=" city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                @error('city')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Position --}}
            <div class="mb-3">
                <label for="position_id" class="form-label">Position</label>
                <select name="position_id" id="position_id" class="form-select" required>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                            {{ ucfirst($position->name) }}
                        </option>
                    @endforeach
                </select>
                @error('position_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Équipe --}}
            <div class="mb-3">
                <label for="equipe_id" class="form-label">Équipe</label>
                <select name="equipe_id" id="equipe_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}" {{ old('equipe_id') == $equipe->id ? 'selected' : '' }}>
                            {{ $equipe->name }}
                        </option>
                    @endforeach
                </select>
                @error('equipe_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="src" class="form-label">Image</label>
                <input type="file" class="form-control" id="src" name="src">
                @error('src')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Créer</button>
            <a href="{{ route('back.joueur.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
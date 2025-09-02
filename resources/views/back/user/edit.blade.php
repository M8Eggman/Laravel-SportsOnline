@extends('layouts.back')

@section('title', "Modifier l'utilisateur")

@section('content')
    <div class="container mt-4">
        <h1>Modifier l'utilisateur : {{ $user->first_name }} {{ $user->last_name }}</h1>

        <form action="{{ route('back.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" id="last_name" name="last_name"
                    class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name', $user->last_name) }}" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" id="first_name" name="first_name"
                    class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name', $user->first_name) }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Rôle</label>
                <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                    <option value="">-- Aucun rôle --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('back.user.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection
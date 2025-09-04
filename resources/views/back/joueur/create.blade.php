@extends('layouts.back')

@section('title', 'Create Player')

@section('content')
    <div class="page-player-create">
        <h1 class="table-title">Create Player</h1>

        <form action="{{ route('back.joueur.store') }}" method="POST" enctype="multipart/form-data" class="form-valo">
            @csrf

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="first_name" name="first_name"
                        value="{{ old('first_name') }}">
                    @error('first_name')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="last_name" name="last_name"
                        value="{{ old('last_name') }}">
                    @error('last_name')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                    <input type="number" class="form-control-valo" id="age" name="age" value="{{ old('age') }}">
                    @error('age')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="genre_id" class="form-label">Gender</label>
                    <select name="genre_id" id="genre_id" class="form-select-valo">
                        <option value="">Other</option>
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
                <div class="form-group mb-3">
                    <label for="position_id" class="form-label">Position <span class="text-danger">*</span></label>
                    <select name="position_id" id="position_id" class="form-select-valo">
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
                <div class="form-group mb-3">
                    <label for="equipe_id" class="form-label">Team</label>
                    <select name="equipe_id" id="equipe_id" class="form-select-valo">
                        <option value="">None</option>
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
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control-valo" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="city" name="city" value="{{ old('city') }}">
                    @error('city')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="src" class="form-label">Image</label>
                <input type="file" class="form-control-valo" id="src" name="src">
                @error('src')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn-valo success">Create</button>
                <a href="{{ route('back.joueur.index') }}" class="btn-valo info">Cancel</a>
            </div>
        </form>
    </div>
@endsection
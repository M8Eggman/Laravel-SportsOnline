@extends('layouts.back')

@section('title', 'Edit Player')

@section('content')
    <div class="page-player-edit">
        <h1 class="table-title">Edit Player: <span class="table-title-name">{{ $joueur->last_name }}
                {{ $joueur->first_name }}</span></h1>

        <form action="{{ route('back.joueur.update', $joueur->id) }}" method="POST" enctype="multipart/form-data"
            class="form-valo">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="first_name" name="first_name"
                        value="{{ old('first_name', $joueur->first_name) }}">
                    @error('first_name')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="last_name" name="last_name"
                        value="{{ old('last_name', $joueur->last_name) }}">
                    @error('last_name')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="age">Age <span class="text-danger">*</span></label>
                    <input type="number" class="form-control-valo" id="age" name="age"
                        value="{{ old('age', $joueur->age) }}">
                    @error('age')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="phone" name="phone"
                        value="{{ old('phone', $joueur->phone) }}">
                    @error('phone')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control-valo" id="email" name="email"
                        value="{{ old('email', $joueur->email) }}">
                    @error('email')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-valo" id="city" name="city"
                        value="{{ old('city', $joueur->city) }}">
                    @error('city')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group mb-3">
                    <label for="position_id">Position <span class="text-danger">*</span></label>
                    <select name="position_id" id="position_id" class="form-select-valo">
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ $joueur->position_id == $position->id ? 'selected' : '' }}>
                                {{ ucfirst($position->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('position_id')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="equipe_id">Team</label>
                    <select name="equipe_id" id="equipe_id" class="form-select-valo">
                        <option value="">None</option>
                        @foreach($equipes as $equipe)
                            <option value="{{ $equipe->id }}" {{ old('equipe_id', $equipe->id) == $equipe->id ? 'selected' : '' }}>
                                {{ $equipe->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipe_id')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="genre_id">Gender</label>
                    <select name="genre_id" id="genre_id" class="form-select-valo">
                        <option value="">Other</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $joueur->genre_id == $genre->id ? 'selected' : '' }}>
                                {{ ucfirst($genre->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="src">Image</label>
                <input type="file" name="src" id="src" class="form-control-valo">
                @error('src')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <p class="required-note">All fields marked with <span class="text-danger">*</span> are required.</p>


            <div class="form-actions mt-4 d-flex gap-3">
                <button type="submit" class="btn-valo success">Update</button>
                <a href="{{ route('back.joueur.index') }}" class="btn-valo info">Cancel</a>
            </div>
        </form>
    </div>
@endsection
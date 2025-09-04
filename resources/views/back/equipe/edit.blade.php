@extends('layouts.back')

@section('title', 'Edit Team')

@section('content')
    <div class="page-team-edit">
        <h1 class="table-title">Edit Team: <span class="table-title-name">{{ $equipe->name }}</span></h1>

        <form action="{{ route('back.equipe.update', $equipe->id) }}" method="POST" enctype="multipart/form-data" class="form-valo">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Team Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control-valo" value="{{ old('name', $equipe->name) }}">
                @error('name')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="city">City <span class="text-danger">*</span></label>
                <input type="text" name="city" id="city" class="form-control-valo" value="{{ old('city', $equipe->city) }}">
                @error('city')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="src">Image</label>
                <input type="file" name="src" id="src" class="form-control-valo">
                @error('src')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="continent_id">Continent</label>
                <select name="continent_id" id="continent_id" class="form-select-valo">
                    <option value="">None</option>
                    @foreach($continents as $continent)
                        <option value="{{ $continent->id }}" {{ $equipe->continent_id == $continent->id ? 'selected' : '' }}>
                            {{ $continent->name }}
                        </option>
                    @endforeach
                </select>
                @error('continent_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="genre_id">Gender</label>
                <select name="genre_id" id="genre_id" class="form-select-valo">
                    <option value="">Mixed</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $equipe->genre_id == $genre->id ? 'selected' : '' }}>
                            {{ ucfirst($genre->name) }}
                        </option>
                    @endforeach
                </select>
                @error('genre_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn-valo warning">Update</button>
                <a href="{{ route('back.equipe.index') }}" class="btn-valo info">Cancel</a>
            </div>
        </form>
    </div>
@endsection

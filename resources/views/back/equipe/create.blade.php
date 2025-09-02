@extends('layouts.back')

@section('title', 'Créer une équipe')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Créer une nouvelle équipe</h4>
                    <a href="{{ route('back.equipe.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('back.equipe.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de l'équipe <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('city') is-invalid @enderror" 
                                           id="city" 
                                           name="city" 
                                           value="{{ old('city') }}"
                                           required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="genre_id" class="form-label">Genre <span class="text-danger">*</span></label>
                                    <select class="form-select @error('genre_id') is-invalid @enderror" 
                                            id="genre_id" 
                                            name="genre_id" 
                                            required>
                                        <option value="">Sélectionner un genre</option>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                                {{ $genre->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('genre_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="continent_id" class="form-label">Continent</label>
                                    <select class="form-select @error('continent_id') is-invalid @enderror" 
                                            id="continent_id" 
                                            name="continent_id">
                                        <option value="">Sélectionner un continent</option>
                                        @foreach($continents as $continent)
                                            <option value="{{ $continent->id }}" {{ old('continent_id') == $continent->id ? 'selected' : '' }}>
                                                {{ $continent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('continent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                <span class="text-danger">*</span> Champs obligatoires
                            </small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('back.equipe.index') }}" class="btn btn-outline-secondary me-md-2">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Créer l'équipe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
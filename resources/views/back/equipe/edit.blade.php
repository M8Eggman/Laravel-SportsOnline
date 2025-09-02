@extends('layouts.back')

@section('title', 'Modifier l\'équipe')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Modifier l'équipe : {{ $equipe->name }}</h4>
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

                    <form action="{{ route('back.equipe.update', $equipe->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de l'équipe <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $equipe->name) }}"
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
                                           value="{{ old('city', $equipe->city) }}"
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
                                            <option value="{{ $genre->id }}" 
                                                {{ (old('genre_id', $equipe->genre_id) == $genre->id) ? 'selected' : '' }}>
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
                                            <option value="{{ $continent->id }}" 
                                                {{ (old('continent_id', $equipe->continent_id) == $continent->id) ? 'selected' : '' }}>
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
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section des joueurs de l'équipe -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Joueurs de l'équipe</h5>
                    <span class="badge bg-primary">{{ $joueurs->count() }} joueur(s)</span>
                </div>
                <div class="card-body">
                    @if($joueurs->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($joueurs as $joueur)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <strong>{{ $joueur->name }}</strong>
                                        @if($joueur->position)
                                            <br><small class="text-muted">{{ $joueur->position->name }}</small>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('back.joueur.show', $joueur->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            Voir
                                        </a>
                                        <a href="{{ route('back.joueur.edit', $joueur->id) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            Modifier
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <p class="mb-0">Aucun joueur dans cette équipe</p>
                        </div>
                    @endif
                    
                    <div class="mt-3">
                        <a href="{{ route('back.joueur.create') }}?equipe_id={{ $equipe->id }}" 
                           class="btn btn-success btn-sm w-100">
                            Ajouter un joueur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
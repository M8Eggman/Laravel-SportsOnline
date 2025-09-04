@extends('layouts.front')

@section('title', 'Teams')

@section('content')
    <div class="container mt-4">
        <h1 class="titre_home">Our Teams</h1>
        <div class="row g-4">
            @forelse ($equipes as $t)
                <div class="col-3">
                    <x-card :title="$t->name" :subtitle="$t->city" :image="$t->src ? asset('storage/' . $t->src) : null"
                        :link="route('equipe.show', $t->id)" :element="$t" />
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No teams found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
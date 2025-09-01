@extends('layouts.front')

@section('content')
    <div id="carouselValorant" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://files.bo3.gg/uploads/image/66139/image/webp-49980b5cf1a5e9c004732e496f37128e.webp"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://admin.esports.gg/wp-content/uploads/2025/05/wolves-esports.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://g2esports.com/cdn/shop/articles/Website-Gozen-Announcement_38421b6e-d3e1-43e6-8806-d8aa94237f94.jpg?v=1634675227"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselValorant" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselValorant" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="container my-5">
        <h2 class="mb-4">European Teams</h2>
        <div class="row g-4">
            @foreach ($europeTeams as $t)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $t->logo_url ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $t->name }}</h5>
                            <p class="card-text">{{ $t->city }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mb-5">
        <h2 class="mb-4">Top European Players</h2>
        <div class="row g-4">
            @foreach ($europePlayers as $p)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $p->photo->src ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->first_name }} {{ $p->last_name }}</h5>
                            <p class="card-text">Position: {{ $p->position->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mb-5">
        <h2 class="mb-4">International Teams</h2>
        <div class="row g-4">
            @foreach ($notEuropeTeams as $t)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $t->logo_url ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $t->name }}</h5>
                            <p class="card-text">{{ $t->city }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mb-5">
        <h2 class="mb-4">International Players</h2>
        <div class="row g-4">
            @foreach ($notEuropePlayers as $p)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $p->photo->src ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->first_name }} {{ $p->last_name }}</h5>
                            <p class="card-text">Position: {{ $p->position->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mb-5">
        <h2 class="mb-4">Free Agents</h2>
        <div class="row g-4">
            @foreach ($freePlayers as $p)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ $p->photo->src ?? 'https://placehold.co/400' }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->first_name }} {{ $p->last_name }}</h5>
                            <p class="card-text">Position: {{ $p->position->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
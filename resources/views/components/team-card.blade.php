@props([
    'name' => '',
    'city' => '',
    'logo' => null,
    'link' => null
])

<div class="card h-100 shadow-sm rounded-3">
    <img src="{{ $logo ?? 'https://placehold.co/400' }}" class="card-img-top" alt="{{ $name }}">
    <div class="card-body">
        @if($link)
            <h5 class="card-title">
                <a href="{{ $link }}" class="text-decoration-none text-dark">{{ $name }}</a>
            </h5>
        @else
            <h5 class="card-title">{{ $name }}</h5>
        @endif
        <p class="card-text">{{ $city }}</p>
    </div>
</div>

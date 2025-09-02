@props([
    'title' => '',
    'subtitle' => '',
    'image' => null,
    'link' => null
])

<div class="card h-100 rounded-3">
    <img src="{{ $image ?? 'https://placehold.co/400' }}" class="card-img-top" alt="{{ $title }}">
    <div class="card-body">
        @if($link)
            <h5 class="card-title">
                <a href="{{ $link }}" class="text-decoration-none text-dark">{{ $title }}</a>
            </h5>
        @else
            <h5 class="card-title">{{ $title }}</h5>
        @endif
        <p class="card-text">{{ $subtitle }}</p>
    </div>
</div>
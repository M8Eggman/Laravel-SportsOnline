@props([
    'title' => '',
    'subtitle' => '',
    'image' => null,
    'link' => null
])

<div class="card h-100 d-flex flex-column justify-content-between rounded-2">
    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
        <img src="{{ $image ?? 'https://placehold.co/400' }}" class="img-fluid w-100" alt="" style="max-height: 100%; max-width: 100%;">
    </div>
    <div class="card-body mt-auto">
        @if($link)
            <h5 class="card-title mb-1">
                <a href="{{ $link }}" class="text-decoration-none text-dark">{{ $title }}</a>
            </h5>
        @else
            <h5 class="card-title mb-1">{{ $title }}</h5>
        @endif
        <p class="card-text">{{ $subtitle }}</p>
    </div>
</div>
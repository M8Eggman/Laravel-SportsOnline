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
        <h5 class="card-title mb-1">{{ $title }}</h5>
        <p class="card-text mb-2">{{ $subtitle }}</p>
        @if($link)
            <a href="{{ $link }}" class="btn btn-primary btn-sm">See More</a>
        @endif
    </div>
</div>
@props([
    'title' => '',
    'subtitle' => '',
    'element'=> null,
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
        <div class="d-flex justify-content-between">
            @if($link)
                <a href="{{ $link }}" class="btn btn-primary btn-sm">See More</a>
            @endif
            @if ($element)
                {{-- Vérifie si c'est une équipe --}}
                @if($element instanceof \App\Models\Equipe)
                    @can('update-equipe', $element)
                        <a href="{{ route('back.equipe.edit', $element->id) }}" class="btn btn-info btn-sm">Modify Team</a>
                    @endcan
                {{-- Vérifie si c'est un joueur --}}
                @elseif($element instanceof \App\Models\Joueur)
                    @can('update-joueur', $element)
                        <a href="{{ route('back.joueur.edit', $element->id) }}" class="btn btn-info btn-sm">Modify Player</a>
                    @endcan
                @endif
            @endif
        </div>
    </div>
</div>
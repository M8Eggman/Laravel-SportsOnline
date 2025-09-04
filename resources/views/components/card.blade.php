@props([
    'title' => '',
    'subtitle' => '',
    'element'=> null,
    'image' => null,
    'link' => null
])

<div class="card h-100 d-flex flex-column justify-content-between rounded-2">
    <div class="d-flex justify-content-center align-items-center card_div_img" style="height: 300px;">
        <img src="{{ $image ?? 'https://placehold.co/400' }}" class="card_img" alt="">
    </div>
        @if ($element)
            @if($element instanceof \App\Models\Equipe)
                @can('update-equipe', $element)
                    <a href="{{ route('back.equipe.edit', $element->id) }}" class="btn_modify">Modify Team</a>
                @endcan
            @elseif($element instanceof \App\Models\Joueur)
                @can('update-joueur', $element)
                    <a href="{{ route('back.joueur.edit', $element->id) }}" class="btn_modify">Modify Player</a>
                @endcan
            @endif
        @endif
    <div class="card-body mt-auto">
        <h5 class="card-title mb-1">{{ $title }}</h5>
        <p class="card-text mb-2">{{ $subtitle }}</p>
        <div class="d-flex justify-content-center">
            @if($link)
                <a class="user-profile" href="{{ $link }}" >
                    <div class="user-profile-inner">
                        <span>See More</span>
                    </div>
                </a>
            @endif
        </div>
    </div>
</div>
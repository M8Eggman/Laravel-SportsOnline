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
                {{-- Vérifie si c'est une équipe --}}
                @if($element instanceof \App\Models\Equipe)
                    @can('update-equipe', $element)
                        <a href="{{ route('back.equipe.edit', $element->id) }}" class="btn_modify">Modify Team</a>
                    @endcan
                {{-- Vérifie si c'est un joueur --}}
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
                <div
                aria-label="User Login Button"
                tabindex="0"
                role="button"
                class="user-profile"
                >
                    <div class="user-profile-inner">
                        <a href="{{ $link }}">See More</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
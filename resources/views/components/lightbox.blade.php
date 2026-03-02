<div id="lightboxModal-{{ $id }}" class="lightboxModal">
    <span class="lightbox-close">&times;</span>
    <div class="swiper lightBox myLightbox-{{ $id }}">
        <div class="swiper-wrapper">
            @foreach($items as $item)
                @php
                    $isMedia = $item instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media;
                    $src = $isMedia ? $item->getUrl($versionImage) : ($item['src'] ?? '');
                    $legenda = $isMedia ? $item->getCustomProperty('legenda') : ($item['legenda'] ?? null);
                @endphp
                <div class="swiper-slide">
                    <img src="{{ $src }}" loading="lazy">
                    <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    @if($useLegenda && $legenda)
                        <div class="swiper-caption-modal">
                            {{ $legenda }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
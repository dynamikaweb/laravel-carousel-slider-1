@props(['items', 'id', 'versionImage', 'useLegenda', 'cdn', 'layout', 'autoplay', 'delay', 'class'])

@if (count($items) > 0)
    <div class="carousel-slider-1">
        <div class="container-swiper layout-{{ $layout }}" id="{{ $id }}" data-layout="{{ $layout }}"data-autoplay="{{ $autoplay ? 'true' : 'false' }}" data-delay="{{ $delay }}">
            <div class="swiper-gallery-wrapper">
                <div class="swiper mySwiper2 {{ $class }}">
                    <div class="swiper-wrapper">
                        @foreach($items as $index => $item)
                            @php
                                $isMedia = $item instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media;
                                $src = $isMedia ? $item->getUrl($versionImage) : ($item['src'] ?? '');
                                $legenda = $isMedia ? $item->getCustomProperty('legenda') : ($item['legenda'] ?? null);
                            @endphp
                            <div class="swiper-slide">
                                <a href="#" class="open-lightbox" data-index="{{ $index }}">
                                    <img src="{{ $src }}" class="carousel-main-image" loading="lazy">
                                </a>
                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                
                                @if($useLegenda && $legenda)
                                    <div class="swiper-caption-bottom">
                                        {{ $legenda }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if(count($items) > 1)
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    @endif
                </div>
        
                @if(count($items) > 1 && $layout !== 'notumbs')
                    <div thumbsSlider class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($items as $item)
                                @php
                                    $isMedia = $item instanceof \Spatie\MediaLibrary\MediaCollections\Models\Media;
                                    $thumb = $isMedia ? $item->getUrl('small') : ($item['thumb'] ?? $item['src']);
                                @endphp
                                <div class="swiper-slide">
                                    <img src="{{ $thumb }}" class="carousel-thumb-image" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('carousel-slider-1::components.lightbox', ['id' => $id, 'items' => $items, 'useLegenda' => $useLegenda, 'versionImage' => $versionImage])
    </div>
    @once
        @if($cdn)
            @push('styles')
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            @endpush
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            @endpush
        @endif
        @push('styles')
            <link rel="stylesheet" href="{{ asset('vendor/dynamikasolucoesweb/carousel-slider-1/css/carousel.css') }}">
        @endpush
        @push('scripts')
            <script src="{{ asset('vendor/dynamikasolucoesweb/carousel-slider-1/js/carousel.js') }}"></script>
            <script>
                (function() {
                    const init = () => {
                        if (window.initCarouselSlider2) {
                            window.initCarouselSlider2("{{ $id }}");
                        }
                    };
                    if (document.readyState === "complete" || document.readyState === "interactive") {
                        init();
                    } else {
                        document.addEventListener("DOMContentLoaded", init);
                    }
                })();
            </script>
        @endpush
    @endonce
@endif


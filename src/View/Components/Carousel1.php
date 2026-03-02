<?php

namespace DynamikaSolucoesWeb\CarouselSlider\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Carousel1 extends Component
{
    public string $id;

    public function __construct(
        public $items,
        public $id_custom = null,
        public bool $cdn = false,
        public $versionImage = '',
        public bool $useLegenda = true,
        public string $layout = 'right',
        public bool $autoplay = true,
        public int $delay = 3000,
        public string $class = ''
    ) {
        $this->id = $id_custom ?? 'carousel-' . Str::random(8);
    }

    public function render()
    {
        return view('carousel-slider-1::components.carousel');
    }
}
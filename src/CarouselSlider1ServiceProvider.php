<?php

namespace DynamikaSolucoesWeb\CarouselSlider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use DynamikaSolucoesWeb\CarouselSlider\View\Components\Carousel1;

class CarouselSlider1ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'carousel-slider-1');
        Blade::component('carousel-slider-1', Carousel1::class);

        $this->publishes([
            __DIR__.'/../resources/assets/js' => public_path('vendor/dynamikasolucoesweb/carousel-slider-1/js'),
            __DIR__.'/../resources/assets/css' => public_path('vendor/dynamikasolucoesweb/carousel-slider-1/css'),
        ], 'carousel-assets-1');
    }
}
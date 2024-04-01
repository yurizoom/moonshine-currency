<?php

namespace YuriZoom\MoonShineCurrency;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'moonshine-currency');
        $this->mergeConfigFrom(__DIR__.'/../config/currency.php', 'moonshine.currency');
    }
}

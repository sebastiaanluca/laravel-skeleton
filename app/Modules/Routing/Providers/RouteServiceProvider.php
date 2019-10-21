<?php

declare(strict_types=1);

namespace Modules\Routing\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        parent::boot();

        $this->forceUriScheme();
        $this->forceBaseUri();
    }

    /**
     * @return void
     */
    private function forceUriScheme() : void
    {
        app(UrlGenerator::class)->forceScheme('https');
    }

    /**
     * @return void
     */
    private function forceBaseUri() : void
    {
        if (! app()->environment('local')) {
            app(UrlGenerator::class)->forceRootUrl(config('app.url'));
        }
    }
}

<?php

declare(strict_types=1);

namespace Modules\Blade\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        BladeX::prefix('x');
        BladeX::component('bladex.*');
    }
}

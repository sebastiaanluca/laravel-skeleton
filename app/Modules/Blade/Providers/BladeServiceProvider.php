<?php

declare(strict_types=1);

namespace Modules\Blade\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot() : void
    {
        BladeX::prefix('x');
        BladeX::component('bladex.*');
    }
}

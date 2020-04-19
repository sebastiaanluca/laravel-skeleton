<?php

declare(strict_types=1);

namespace Modules\Blade\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ImLiam\BladeHelper\Facades\BladeHelper;
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

        BladeHelper::directive('activeLink', static function (string $route) : string {
            return Route::is($route . '*') ? 'link-active' : '';
        });
    }
}

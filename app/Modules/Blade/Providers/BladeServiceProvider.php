<?php

declare(strict_types=1);

namespace Modules\Blade\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ImLiam\BladeHelper\Facades\BladeHelper;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        BladeHelper::directive('activeLink', static function (string $route) : string {
            return Route::is($route . '*') ? 'link-active' : '';
        });
    }
}

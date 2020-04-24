<?php

declare(strict_types=1);

namespace Interfaces\Web\Providers;

use Closure;
use Illuminate\Support\ServiceProvider;
use Interfaces\Web\Enums\WebRoutes;
use Modules\Support\Concerns\LoadsClassesInDirectory;
use ReflectionClass;
use SebastiaanLuca\Router\Routers\Router;

class WebServiceProvider extends ServiceProvider
{
    use LoadsClassesInDirectory;

    public function boot() : void
    {
        $this->load(
            source_path('Interfaces/Web/Routers'),
            Closure::fromCallable([$this, 'registerRouter'])
        );

        if (! class_exists('WebRoutes')) {
            class_alias(WebRoutes::class, 'WebRoutes');
        }
    }

    private function registerRouter(string $router) : void
    {
        if (is_subclass_of($router, Router::class) && ! (new ReflectionClass($router))->isAbstract()) {
            app()->make($router);
        }
    }
}

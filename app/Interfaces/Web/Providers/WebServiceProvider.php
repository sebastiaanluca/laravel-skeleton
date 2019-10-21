<?php

declare(strict_types=1);

namespace Interfaces\Web\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use SebastiaanLuca\Router\Routers\Router;
use Symfony\Component\Finder\Finder;
use function Support\source_path;

class WebServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        parent::register();

        $this->load(source_path('Interfaces/Web/Routers'));
    }

    /**
     * Register all of the commands in the given directory.
     *
     * @param array<string>|string $paths
     *
     * @return void
     */
    protected function load($paths) : void
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, static function ($path) : bool {
            return is_dir($path);
        });

        if (empty($paths)) {
            return;
        }

        foreach ((new Finder)->in($paths)->files() as $router) {
            $router = str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($router->getPathname(), realpath(source_path()) . DIRECTORY_SEPARATOR)
            );

            if (is_subclass_of($router, Router::class) && ! (new ReflectionClass($router))->isAbstract()) {
                app()->make($router);
            }
        }
    }
}

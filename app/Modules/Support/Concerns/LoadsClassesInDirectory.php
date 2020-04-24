<?php

declare(strict_types=1);

namespace Modules\Support\Concerns;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

trait LoadsClassesInDirectory
{
    /**
     * Register all of the commands in the given directory.
     *
     * @param array<string>|string $paths
     * @param \Closure $callback
     *
     * @return void
     */
    protected function load($paths, Closure $callback) : void
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, static function ($path) : bool {
            return is_dir($path);
        });

        if (empty($paths)) {
            return;
        }

        foreach ((new Finder)->in($paths)->files() as $class) {
            $class = str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($class->getPathname(), realpath(source_path()) . DIRECTORY_SEPARATOR)
            );

            $callback($class);
        }
    }
}

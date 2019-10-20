<?php

declare(strict_types=1);

namespace Interfaces\Cli\Providers;

use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class CliServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        parent::register();

        $this->load(__DIR__ . '/../Commands');
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

        $namespace = $this->app->getNamespace();

        foreach ((new Finder)->in($paths)->files() as $command) {
            $command = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($command->getPathname(), realpath(app_path()) . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($command, Command::class) &&
                ! (new ReflectionClass($command))->isAbstract()) {
                Artisan::starting(static function ($artisan) use ($command) : void {
                    $artisan->resolve($command);
                });
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace Interfaces\Console\Providers;

use Closure;
use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Modules\Support\Concerns\LoadsClassesInDirectory;
use ReflectionClass;
use function Modules\Support\source_path;

class ConsoleServiceProvider extends ServiceProvider
{
    use LoadsClassesInDirectory;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->load(
            source_path('Interfaces/Console/Commands'),
            Closure::fromCallable([$this, 'registerCommand'])
        );
    }

    /**
     * @param string $command
     */
    private function registerCommand(string $command) : void
    {
        if (is_subclass_of($command, Command::class) && ! (new ReflectionClass($command))->isAbstract()) {
            Artisan::starting(static function ($artisan) use ($command) : void {
                $artisan->resolve($command);
            });
        }
    }
}

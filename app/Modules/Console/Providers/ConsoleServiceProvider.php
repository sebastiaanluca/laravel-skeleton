<?php

declare(strict_types=1);

namespace Modules\Console\Providers;

use Framework\Exceptions\Handler;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Console\Exceptions\ScheduledCommandException;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot() : void
    {
        Event::macro('logExceptionOnFailure', function () : Event {
            $this->ensureOutputIsBeingCaptured();

            return $this->onFailure(function () {
                app(Handler::class)->report(ScheduledCommandException::failed($this));
            });
        });
    }
}

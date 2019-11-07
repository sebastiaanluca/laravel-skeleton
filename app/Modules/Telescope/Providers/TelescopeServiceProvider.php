<?php

declare(strict_types=1);

namespace Modules\Telescope\Providers;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        Telescope::ignoreMigrations();

        $this->hideSensitiveRequestDetails();

        Telescope::filter(Closure::fromCallable([$this, 'filter']));
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     *
     * @return void
     */
    protected function hideSensitiveRequestDetails() : void
    {
        if ($this->app->isLocal()) {
            return;
        }

        Telescope::hideRequestParameters([
            '_token',
            'password_hash',
            'avatar',
            'images',
            'logo',
            'media',
        ]);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     *
     * @return void
     */
    protected function gate() : void
    {
        Gate::define('viewTelescope', static function ($user) : bool {
            return false;
        });
    }

    /**
     * @param \Laravel\Telescope\IncomingEntry $entry
     *
     * @return bool
     */
    private function filter(IncomingEntry $entry) : bool
    {
        if ($entry->type === EntryType::REQUEST) {
            return ! in_array(
                $entry->content['method'],
                Arr::get($this->getIgnoredRequests(), $entry->content['uri'], []),
                true
            );
        }

        return true;
    }

    /**
     * @return array
     */
    private function getIgnoredRequests() : array
    {
        return config('telescope.ignored_requests', []);
    }
}

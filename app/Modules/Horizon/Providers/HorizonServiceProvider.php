<?php

declare(strict_types=1);

namespace Modules\Horizon\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        parent::boot();

        Horizon::routeMailNotificationsTo(config('mail.support_email'));
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate() : void
    {
        Gate::define('viewHorizon', static function ($user) : bool {
            return false;
        });
    }
}

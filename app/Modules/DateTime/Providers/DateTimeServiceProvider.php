<?php

declare(strict_types=1);

namespace Modules\DateTime\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Modules\DateTime\Mixins\CarbonMixin;

class DateTimeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() : void
    {
        Carbon::mixin(new CarbonMixin);
    }
}

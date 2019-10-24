<?php

declare(strict_types=1);

namespace Modules\Database\Providers;

use Illuminate\Database\Schema\MySqlBuilder;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        MySqlBuilder::defaultStringLength(190);
    }
}

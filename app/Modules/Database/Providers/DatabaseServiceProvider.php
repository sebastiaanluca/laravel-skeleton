<?php

declare(strict_types=1);

namespace Modules\Database\Providers;

use Illuminate\Database\Schema\MySqlBuilder;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot() : void
    {
        MySqlBuilder::defaultStringLength(190);
    }
}

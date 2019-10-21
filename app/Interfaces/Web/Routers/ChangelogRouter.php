<?php

declare(strict_types=1);

namespace Interfaces\Web\Routers;

use SebastiaanLuca\Changelog\Changelog;
use SebastiaanLuca\Router\Routers\Router;

class ChangelogRouter extends Router
{
    /**
     * Map the routes.
     *
     * @return void
     */
    public function map() : void
    {
        Changelog::routes();
    }
}

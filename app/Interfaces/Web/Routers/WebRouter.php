<?php

declare(strict_types=1);

namespace Interfaces\Web\Routers;

use SebastiaanLuca\Changelog\Changelog;
use SebastiaanLuca\Router\Routers\Router;

class WebRouter extends Router
{
    /**
     * Map the routes.
     *
     * @return void
     */
    public function map() : void
    {
        $this->router->view('', 'pages/welcome');

        Changelog::routes();
    }
}

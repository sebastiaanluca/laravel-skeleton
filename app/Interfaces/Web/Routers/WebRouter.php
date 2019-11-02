<?php

declare(strict_types=1);

namespace Interfaces\Web\Routers;

use Interfaces\Web\Enums\WebRoutes;
use Interfaces\Web\RequestHandlers\Locale\ChangeLocale;
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
        $this->router->group(['middleware' => 'web'], function () : void {
            $this->router->view('', 'pages/welcome');

            $this->router->get('language/{locale}', ChangeLocale::class)->name(WebRoutes::CHANGE_LOCALE);

            Changelog::routes();
        });
    }
}

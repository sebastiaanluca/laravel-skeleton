<?php

declare(strict_types=1);

namespace Interfaces\Web\Routers;

use Interfaces\Web\Enums\WebRoutes;
use Interfaces\Web\RequestHandlers\Locale\ChangeLocale;
use Interfaces\Web\RequestHandlers\Users\LoginController;
use SebastiaanLuca\Changelog\Changelog;
use SebastiaanLuca\Router\Routers\Router;

class WebRouter extends Router
{
    public function map() : void
    {
        $this->router->group(['middleware' => 'web'], function () : void {
            $this->router->view('', 'pages/welcome')->name('home');

            $this->router->get('language/{locale}', ChangeLocale::class)->name(WebRoutes::CHANGE_LOCALE);

            Changelog::routes();
        });

        $this->router->middleware('web')->group(function () : void {
            $this->router->get('users/login', LoginController::class . '@showLoginForm')->name('login');
            $this->router->post('users/login', LoginController::class . '@login');
            $this->router->get('users/logout', LoginController::class . '@logout')->name('logout');
        });
    }
}

<?php

declare(strict_types=1);

namespace Interfaces\Web\RequestHandlers\Users;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo = 'home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

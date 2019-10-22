<?php

declare(strict_types=1);

namespace Interfaces\Web\RequestHandlers\Locale;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Interfaces\Web\RequestHandlers\RequestHandler;
use Modules\Localization\LocaleManager;

class ChangeLocale extends RequestHandler
{
    /**
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(string $locale) : RedirectResponse
    {
        if ($user = Auth::user()) {
            $user->locale = LocaleManager::getSupportedLocale($locale);

            $user->save();

            return redirect()->back();
        }

        LocaleManager::setSessionLocale($locale);

        return redirect()->back();

    }
}


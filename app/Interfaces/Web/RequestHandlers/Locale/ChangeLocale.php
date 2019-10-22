<?php

declare(strict_types=1);

namespace Interfaces\Web\RequestHandlers\Locale;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Interfaces\Web\RequestHandlers\RequestHandler;
use Modules\Localization\LocalizationManager;

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
            $user->locale = LocalizationManager::getSupportedLocale($locale);

            $user->save();

            return redirect()->back();
        }

        LocalizationManager::setSessionLocale($locale);

        return redirect()->back();

    }
}


<?php

declare(strict_types=1);

namespace Interfaces\Web\RequestHandlers\Locale;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Localization\LocalizationManager;
use Modules\Support\Http\RequestHandler;

class ChangeLocale extends RequestHandler
{
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


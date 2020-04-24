<!doctype html>
<html lang="{{ str_replace('_', '-', locale()) }}" class="bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <title>@yield('title') @hasSection('title') - @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Locales -->
    <link rel="canonical" href="{{ request()->url() }}">
    @foreach(\Modules\Localization\Enums\Locales::values() as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ route(WebRoutes::CHANGE_LOCALE, $locale) }}">
    @endforeach

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🚀</text></svg>">

    <!-- Optimizations -->
    <link rel="preload" href="{{ resource('css/app.css') }}" as="style">
    <link rel="preload" href="{{ resource('js/manifest.js') }}" as="script">
    <link rel="preload" href="{{ resource('js/vendor.js') }}" as="script">
    <link rel="preload" href="{{ resource('js/app.js') }}" as="script">
    @stack('preload')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ resource('css/app.css') }}">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ resource('js/manifest.js') }}" defer></script>
    <script src="{{ resource('js/vendor.js') }}" defer></script>
    <script src="{{ resource('js/app.js') }}" defer></script>
    @stack('js')
</head>

<body class="leading-normal font-sans font-normal text-gray-900 antialiased">
    <div id="app" v-cloak>
        <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>

        {{ $slot }}
    </div>

    <!-- Prevent CSS3 transitions from flashing on page load -->
    <script> </script>
</body>
</html>

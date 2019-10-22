<!doctype html>
<html lang="{{ str_replace('_', '-', locale()) }}" class="bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>@yield('title') @hasSection('title') - @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Locales -->
    <link rel="canonical" href="{{ request()->url() }}">
    @foreach(\Modules\Localization\Enums\Locales::values() as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ route(WebRoutes::CHANGE_LOCALE, $locale) }}">
    @endforeach

    <!-- Optimizations -->
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
    <link rel="preload" href="{{ mix('js/manifest.js') }}" as="script">
    <link rel="preload" href="{{ mix('js/vendor.js') }}" as="script">
    <link rel="preload" href="{{ mix('js/app.js') }}" as="script">
    @stack('preload')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('styles')
</head>

<body class="leading-normal font-sans font-normal text-gray-900 antialiased">
    <div id="app" v-cloak>
        {{ $slot }}
    </div>

    <!-- js -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('js')
</body>

</html>

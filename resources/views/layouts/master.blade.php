<!doctype html>
<html lang="{{ str_replace('_', '-', locale()) }}" class="bg-white antialiased">

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
    <link rel="preload" href="{{ mix('styles/app.css') }}" as="style">
    <link rel="preload" href="{{ mix('scripts/manifest.js') }}" as="script">
    <link rel="preload" href="{{ mix('scripts/vendor.js') }}" as="script">
    <link rel="preload" href="{{ mix('scripts/app.js') }}" as="script">
    @stack('preload')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('styles/app.css') }}">
    @stack('styles')
</head>

<body class="bg-gray-200 font-sans leading-normal font-normal text-gray-800">
    <div id="app" v-cloak>
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <script src="{{ mix('scripts/manifest.js') }}"></script>
    <script src="{{ mix('scripts/vendor.js') }}"></script>
    <script src="{{ mix('scripts/app.js') }}"></script>
    @stack('scripts')
</body>

</html>

<?php

return [

    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),

    // Capture release as git sha
    'release' => commit_hash(),

    // Capture bindings on SQL queries logged in breadcrumbs
    'breadcrumbs' => [
        'sql_bindings' => true,
    ],

];

<?php

return [

    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),

    // Capture release as git sha
    'release' => static function () : ?string {
        $commitHash = base_path('.commit_hash');

        if (file_exists($commitHash)) {
            return trim(exec(sprintf('cat %s', $commitHash)));
        }

        if (is_dir(base_path('.git'))) {
            return trim(exec('git --git-dir ' . base_path('.git') . ' log --pretty="%h" -n1 HEAD'));
        }

        return null;
    },

    'breadcrumbs' => [

        // Capture bindings on SQL queries logged in breadcrumbs
        'sql_bindings' => true,

    ],

];

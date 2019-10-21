<?php

declare(strict_types=1);

namespace Support;

/**
 * Get the path to the source of the classes.
 *
 * @param string $path
 *
 * @return string
 */
function source_path($path = '') : string
{
    return base_path('app' . DIRECTORY_SEPARATOR . $path);
}

/**
 * Get the Git commit hash of the currently checked out branch/commit as a string.
 *
 * @return string|null
 */
function commit_hash() : ?string
{
    $commitHash = base_path('.commit_hash');

    if (file_exists($commitHash)) {
        return trim(exec(sprintf('cat %s', $commitHash)));
    }

    if (is_dir(base_path('.git'))) {
        return trim(exec('git --git-dir ' . base_path('.git') . ' log --pretty="%h" -n1 HEAD'));
    }

    return null;
}

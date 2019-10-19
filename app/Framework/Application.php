<?php

namespace PHPUnit\Framework;

use Illuminate\Foundation\Application as LaravelApplication;

class Application extends LaravelApplication
{
    /**
     * The application namespace.
     *
     * @var string
     */
    protected $namespace = 'Framework\\';

    /**
     * Get the path to the application "app" directory.
     *
     * @param string $path
     *
     * @return string
     */
    public function path($path = '') : string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'app/Framework' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

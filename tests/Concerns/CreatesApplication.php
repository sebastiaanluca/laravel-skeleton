<?php

declare(strict_types=1);

namespace Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Application;
use Illuminate\Hashing\ArgonHasher;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() : Application
    {
        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->configureHasher();

        return $app;
    }

    /**
     * Configure the default Argon hasher to use less resources.
     *
     * @return void
     */
    protected function configureHasher() : void
    {
        $hasher = app(Hasher::class);

        if ($hasher instanceof ArgonHasher) {
            $hasher->setMemory(128);
            $hasher->setThreads(1);
            $hasher->setTime(1);
        }
    }
}

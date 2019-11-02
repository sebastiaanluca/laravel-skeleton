<?php

declare(strict_types=1);

namespace Tests\Concerns\Api;

use Spatie\Snapshots\Drivers\JsonDriver;
use Spatie\Snapshots\Filesystem;
use Spatie\Snapshots\Snapshot;

trait JsonSnapshot
{
    /**
     * @param string $key
     * @param callable $fn
     *
     * @return string
     */
    public function snapshot(string $key, callable $fn) : string
    {
        $filesystem = new Filesystem($this->snapshotsFolder());
        $driver = new JsonDriver;
        $snapshot = new Snapshot($key, $filesystem, $driver);

        if ($snapshot->exists()) {
            return $filesystem->read(sprintf('%s.json', $key));
        }

        $snapshot->create($fn());

        return $filesystem->read(sprintf('%s.json', $key));
    }

    /**
     * @return string
     */
    private function snapshotsFolder() : string
    {
        return storage_path('tests/snapshots/api');
    }
}

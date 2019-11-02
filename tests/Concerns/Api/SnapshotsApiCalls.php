<?php

declare(strict_types=1);

namespace Tests\Concerns\Api;

use GuzzleHttp\Client;

trait SnapshotsApiCalls
{
    /**
     * @return void
     */
    protected function setUpSnapshotsApiCalls() : void
    {
        $this->app->bind(Client::class, SnapshotClient::class);
    }
}

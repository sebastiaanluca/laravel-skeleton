<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\Api\SnapshotsApiCalls;
use Tests\Concerns\Asserts;
use Tests\Concerns\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use SnapshotsApiCalls;
    use Asserts;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits() : array
    {
        $uses = parent::setUpTraits();

        foreach ($uses as $trait => $flippedIndex) {
            if (method_exists($this, $method = 'setUp' . class_basename($trait))) {
                $this->$method();
            }
        }

        return $uses;
    }
}

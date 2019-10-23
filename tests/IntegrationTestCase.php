<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class IntegrationTestCase extends TestCase
{
    use RefreshDatabase;
}

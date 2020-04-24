<?php

namespace Tests\Unit\Modules\DateTime;

use Illuminate\Support\Carbon;
use Tests\TestCase;

class CarbonTimezoneTest extends TestCase
{
    /**
     * @test
     */
    public function dates are in the utc timezone() : void
    {
        $this->assertSame(
            'UTC',
            now()->timezoneName,
        );
    }

    /**
     * @test
     */
    public function a date in the display timezone can be converted to the utc timezone() : void
    {
        $this->assertSame(
            'UTC',
            Carbon::fromDisplayTimezone('2019-10-23 23:09:53')->timezoneName,
        );
    }

    /**
     * @test
     */
    public function a utc date can be converted to the display timezone() : void
    {
        $this->assertSame(
            config('app.display_timezone'),
            now()->toDisplayTimezone()->timezoneName,
        );
    }
}

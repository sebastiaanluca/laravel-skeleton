<?php

namespace Tests\Unit\Modules\DateTime;

use Illuminate\Support\Carbon;
use Modules\Eloquent\Models\Model;
use Tests\TestCase;

class StandardizesDatesTest extends TestCase
{
    /**
     * @test
     */
    public function it converts date objects to the utc timezone() : void
    {
        $class = new class extends Model
        {
            public function asDateTimeTest($value) : Carbon
            {
                return $this->asDateTime($value);
            }
        };

        config()->set('app.display_timezone', 'Europe/Brussels');

        $date = Carbon::parse('2019-10-24 01:15:24', config('app.display_timezone'));
        $parsedDate = $class->asDateTimeTest($date);

        $this->assertSame('Europe/Brussels', $date->timezoneName);
        $this->assertSame('2019-10-24 01:15:24', $date->format('Y-m-d H:i:s'));

        $this->assertSame('UTC', $parsedDate->timezoneName);
        $this->assertSame('2019-10-23 23:15:24', $parsedDate->format('Y-m-d H:i:s'));
    }
}

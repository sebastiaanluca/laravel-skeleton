<?php

namespace Tests\Unit\DateTime\TimezoneTest;

use Illuminate\Support\Facades\Auth;
use Modules\DateTime\DateTimeManager;
use Tests\TestCase;

class DateTimeManagerTest extends TestCase
{
    /**
     * @test
     */
    public function it automatically sets the display timezone based on the user timezone() : void
    {
        $user = new class
        {
            public $timezone = 'Australia/Melbourne';
        };

        Auth::shouldReceive('user')->once()->andReturn($user);

        DateTimeManager::autoSetDisplayTimezone();

        $this->assertSame(
            'Australia/Melbourne',
            config()->get('app.display_timezone'),
        );
    }

    /**
     * @test
     */
    public function it automatically sets the display timezone based on the session timezone() : void
    {
        session()->put('app.display_timezone', 'America/Cayman');

        DateTimeManager::autoSetDisplayTimezone();

        $this->assertSame(
            'America/Cayman',
            config()->get('app.display_timezone'),
        );
    }

    /**
     * @test
     */
    public function it automatically sets the current display timezone when it could not be determiend() : void
    {
        config()->set('app.display_timezone', 'Africa/Bamako');

        DateTimeManager::autoSetDisplayTimezone();

        $this->assertSame(
            'Africa/Bamako',
            config()->get('app.display_timezone'),
        );
    }

    /**
     * @test
     */
    public function it automatically sets the current display timezone when an invalid timezone is provided() : void
    {
        config()->set('app.display_timezone', 'Current');
        session()->put('app.display_timezone', 'Invalid');

        DateTimeManager::autoSetDisplayTimezone();

        $this->assertSame(
            'Current',
            config()->get('app.display_timezone'),
        );
    }

    /**
     * @test
     */
    public function it can set the session display timezone() : void
    {
        $this->assertNull(session()->get('app.display_timezone'));

        DateTimeManager::setSessionDisplayTimezone('Asia/Damascus');

        $this->assertSame(
            'Asia/Damascus',
            session()->get('app.display_timezone'),
        );
    }

    /**
     * @test
     */
    public function it does not set an invalid session display timezone() : void
    {
        $this->assertNull(session()->get('app.display_timezone'));

        DateTimeManager::setSessionDisplayTimezone('Invalid');

        $this->assertSame(
            config('app.display_timezone'),
            session()->get('app.display_timezone'),
        );
    }
}

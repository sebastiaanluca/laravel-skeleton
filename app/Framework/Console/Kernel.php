<?php

declare(strict_types=1);

namespace Framework\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Laravel\Horizon\Console\SnapshotCommand as SnapshotHorizon;
use Laravel\Telescope\Console\PruneCommand as PruneTelescopeEntries;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule) : void
    {
        $this->scheduleMaintenanceJobs($schedule);
    }

    protected function scheduleMaintenanceJobs(Schedule $schedule) : void
    {
        $schedule->command(SnapshotHorizon::class)->everyFiveMinutes();
        $schedule->command(PruneTelescopeEntries::class, ['--hours' => 168])->daily();
    }
}

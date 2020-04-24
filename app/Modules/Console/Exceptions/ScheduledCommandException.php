<?php

declare(strict_types=1);

namespace Modules\Console\Exceptions;

use Exception;
use Illuminate\Console\Scheduling\Event;

class ScheduledCommandException extends Exception
{
    /**
     * @param \Illuminate\Console\Scheduling\Event $event
     *
     * @return static
     */
    public static function failed(Event $event) : self
    {
        $output = file_exists($event->output)
            ? file_get_contents($event->output)
            : 'No output found.';

        return new static(sprintf(
            'The scheduled command `%s` failed to complete successfully. %s',
            $event->command ?? $event->description,
            $output,
        ));
    }
}

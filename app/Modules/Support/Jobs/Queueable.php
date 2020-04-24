<?php

declare(strict_types=1);

namespace Modules\Support\Jobs;

use Illuminate\Bus\Queueable as IlluminateQueueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Use this trait and implement the \Illuminate\Contracts\Queue\ShouldQueue interface to allow a
 * job to be queued.
 */
trait Queueable
{
    use Dispatchable, InteractsWithQueue, IlluminateQueueable, SerializesModels;
}

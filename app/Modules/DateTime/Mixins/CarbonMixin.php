<?php

declare(strict_types=1);

namespace Modules\DateTime\Mixins;

use Closure;
use Illuminate\Support\Carbon;

class CarbonMixin
{
    /**
     * @return \Closure
     */
    public static function fromDisplayTimezone() : Closure
    {
        return function ($datetime) : Carbon {
            $instance = Carbon::parse($datetime, config('app.display_timezone'));

            $instance->setTimezone(config('app.timezone'));

            return $instance;
        };
    }

    /**
     * @return \Closure
     */
    public function toDisplayTimezone() : Closure
    {
        return function () : Carbon {
            $instance = $this->copy();

            $instance->setTimezone(config('app.display_timezone'));

            return $instance;
        };
    }
}

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
    public static function fromLocalTimezone() : Closure
    {
        return static function ($datetime) : Carbon {
            $instance = Carbon::parse($datetime, config('app.display_timezone'));

            $instance->setTimezone(config('app.timezone'));

            return $instance;
        };
    }

    /**
     * @return \Closure
     */
    public function toLocalTimezone() : Closure
    {
        return static function () : Carbon {
            $instance = $this->copy();

            $instance->setTimezone(config('app.display_timezone'));

            return $instance;
        };
    }
}

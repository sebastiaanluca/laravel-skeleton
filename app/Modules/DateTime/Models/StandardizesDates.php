<?php

declare(strict_types=1);

namespace Modules\DateTime\Models;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

trait StandardizesDates
{
    /**
     * Return a timestamp as DateTime object.
     *
     * Converts Carbon objects from their current timezone to UTC
     * to ensure full compliance with our UTC standard.
     *
     * @param mixed $value
     *
     * @return \Illuminate\Support\Carbon
     */
    protected function asDateTime($value) : Carbon
    {
        if ($value instanceof CarbonInterface) {
            $value = $value->copy()->timezone('UTC');
        }

        return parent::asDateTime($value);
    }
}

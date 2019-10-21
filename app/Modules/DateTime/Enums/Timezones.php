<?php

declare(strict_types=1);

namespace Modules\DateTime\Enums;

use SebastiaanLuca\PhpHelpers\Classes\Enum;

class Timezones
{
    use Enum;

    /**
     * @var string
     */
    public const UTC = 'UTC';

    /**
     * @var string
     */
    public const EUROPE_BRUSSELS = 'Europe/Brussels';
}

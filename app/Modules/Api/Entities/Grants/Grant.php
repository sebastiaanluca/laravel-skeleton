<?php

declare(strict_types=1);

namespace Modules\Api\Entities\Grants;

interface Grant
{
    /**
     * @return string
     */
    public function grantType() : string;
}

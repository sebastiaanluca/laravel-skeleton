<?php

declare(strict_types=1);

namespace Modules\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Modules\Database\Concerns\ManagesDatabase;
use Modules\Database\Exceptions\MigrationException;

abstract class Migration extends BaseMigration
{
    use ManagesDatabase;

    public function down() : void
    {
        throw MigrationException::undoNotSupported();
    }
}

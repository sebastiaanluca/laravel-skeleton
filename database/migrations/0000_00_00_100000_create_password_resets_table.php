<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Database\Migration;

class CreatePasswordResetsTable extends Migration
{
    public function up() : void
    {
        $this->schema()->create('password_resets', static function (Blueprint $table) : void {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }
}

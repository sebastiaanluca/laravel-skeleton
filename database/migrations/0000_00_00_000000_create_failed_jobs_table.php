<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Database\Migration;

class CreateFailedJobsTable extends Migration
{
    public function up() : void
    {
        $this->schema()->create('failed_jobs', static function (Blueprint $table) : void {
            $table->id();

            $table->text('connection');
            $table->text('queue');

            $table->longText('payload');
            $table->longText('exception');

            $table->timestamp('failed_at')->useCurrent();
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Database\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        $this->schema()->create('password_resets', static function (Blueprint $table) : void {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
}

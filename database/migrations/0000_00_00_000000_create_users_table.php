<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up() : void
    {
        $this->schema()->create('users', static function (Blueprint $table) : void {
            $table->id();

            $table->string('email')->unique();

            $table->string('name');
            $table->string('display_name');
            $table->string('locale', 8)->default('en');
            $table->string('timezone', 40)->default('Europe/Brussels');

            $table->string('password')->nullable();
            $table->rememberToken();

            $table->timestamp('accepted_terms_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->unique(['email', 'deleted_at']);
        });
    }
}

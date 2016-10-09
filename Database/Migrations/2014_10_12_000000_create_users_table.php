<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) 
        {
            Schema::create('users', function (Blueprint $table) 
            {
                $table->increments('id');
                $table->string('name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->string('language', 10)->default('en');
                $table->tinyInteger('status')->default(1);
                $table->string('level')->default('visitor');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

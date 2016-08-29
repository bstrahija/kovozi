<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('main_group_id')->unsigned()->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->text('uploaded_avatar')->nullable();
            $table->text('social_avatar')->nullable();
            $table->string('facebook_id')->nullable()->index();
            $table->string('google_id')->nullable()->index();
            $table->string('github_id')->nullable()->index();
            $table->string('slack_webhook_url')->nullable();
            $table->string('auth_token', 100)->index()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
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

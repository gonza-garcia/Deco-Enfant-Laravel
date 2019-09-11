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
            $table->smallIncrements     ('id');
            $table->string              ('username')         ->nullable(false);
            $table->string              ('first_name',  50)  ->nullable(false);
            $table->string              ('last_name',   50)  ->nullable(false);
            $table->string              ('email')            ->nullable(false)->unique();
            $table->string              ('password')         ->nullable(false);
            $table->string              ('phone')            ->nullable();
            $table->datetime            ('date_of_birth')    ->nullable(false);
            $table->unsignedSmallInteger('province_id')      ->nullable(false);
            $table->unsignedTinyInteger ('sex_id')           ->nullable(false);
            $table->unsignedTinyInteger ('role_id')          ->nullable(false)->default(2);
            $table->unsignedTinyInteger ('user_status_id')   ->nullable(false)->default(1);
            $table->timestamp           ('email_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign             ('province_id')      ->references('id')->on('provinces');
            $table->foreign             ('sex_id')           ->references('id')->on('sexes');
            $table->foreign             ('role_id')          ->references('id')->on('roles');
            $table->foreign             ('user_status_id')   ->references('id')->on('user_statuses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

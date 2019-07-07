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
            $table->BigIncrements('id');
            $table->string('name');
            $table->string('first_name',50)->nullable(false);
            $table->string('last_name',50)->nullable(false);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('sex_id')->nullable();
            $table->unsignedBigInteger('role_id')->default(2);
            $table->unsignedBigInteger('user_status_id')->default(1);
            $table->timestamps();
            $table->softDeletes(); // tambien debo indicarlo en el modelo
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('sex_id')->references('id')->on('sexes');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_status_id')->references('id')->on('user_statuses');

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

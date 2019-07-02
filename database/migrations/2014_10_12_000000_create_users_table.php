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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // agregados
            $table->string('first_name',50)->nullable(false);
            $table->string('last_name',50)->nullable(false);

            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->bigInteger('sex_id')->nullable();
            $table->bigInteger('user_status_id')->nullable();
            $table->bigInteger('role_id')->nullable();

            $table->softDeletes(); // tambien debo indicarlo en el modelo

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

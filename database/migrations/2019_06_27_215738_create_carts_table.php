<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('short_desc',150)->nullable();
            $table->text('long_desc')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('cant')->nullable()->default(0);
            $table->decimal('discount',8,2)->nullable();
            $table->bigInteger('cart_number')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->timestamps();
            $table->softDeletes(); // tambien debo indicarlo en el modelo

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}

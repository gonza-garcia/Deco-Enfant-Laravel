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
            $table->smallIncrements     ('id');
            $table->unsignedSmallInteger('cart_number')     ->nullable(false)->unique();
            $table->string              ('name',        100)->nullable(false);
            $table->string              ('short_desc',  150)->nullable(false);
            $table->string              ('long_desc',   250)->nullable();
            $table->string              ('thumbnail')       ->nullable(false);
            $table->unsignedDecimal     ('price',       8,2)->nullable(false);
            $table->unsignedTinyInteger ('discount')        ->nullable(false);
            $table->unsignedSmallinteger('cant')            ->nullable(false);
            $table->unsignedTinyInteger ('status')          ->nullable()->default(0);
            $table->unsignedTinyInteger ('color_id')        ->nullable();
            $table->unsignedTinyInteger ('size_id')         ->nullable();
            $table->unsignedSmallInteger('subcategory_id')  ->nullable(false);
            $table->unsignedSmallInteger('user_id')         ->nullable(false);

            $table->timestamps();
            $table->softDeletes(); // tambien debo indicarlo en el modelo

            $table->foreign('color_id')         ->references('id')->on('colors');
            $table->foreign('size_id')          ->references('id')->on('sizes');
            $table->foreign('subcategory_id')   ->references('id')->on('subcategories');
            $table->foreign('user_id')          ->references('id')->on('users');
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

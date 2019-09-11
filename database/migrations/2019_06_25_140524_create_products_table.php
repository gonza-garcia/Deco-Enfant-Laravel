<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->smallIncrements     ('id');
            $table->string              ('name',        100)->nullable(false);
            $table->string              ('short_desc',  150)->nullable(false);
            $table->string              ('long_desc',   250)->nullable();
            $table->string              ('thumbnail')       ->nullable(false);
            $table->unsignedDecimal     ('price',       8,2)->nullable(false);
            $table->unsignedTinyInteger ('discount')        ->nullable(false)   ->default(0);
            $table->unsignedSmallInteger('stock')           ->nullable(false)   ->default(0);
            $table->unsignedTinyInteger ('color_id')        ->nullable()        ->default(1);
            $table->unsignedTinyInteger ('size_id')         ->nullable()        ->default(1);
            $table->unsignedSmallInteger('subcategory_id')  ->nullable(false)   ->default(1);

            $table->timestamps();
            $table->softDeletes(); // tambien debo indicarlo en el modelo

            $table->foreign             ('color_id')        ->references('id')->on('colors');
            $table->foreign             ('size_id')         ->references('id')->on('sizes');
            $table->foreign             ('subcategory_id')  ->references('id')->on('subcategories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

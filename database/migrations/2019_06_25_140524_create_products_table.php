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
            $table->BigIncrements('id');
            $table->string('name',100);
            $table->string('short_desc',150);
            $table->string('long_desc',250);
            $table->decimal('price',6,2);
            $table->string('thumbnail');
            $table->integer('stock')->default(0);
            $table->integer('discount')->default(0);
            $table->unsignedBigInteger('color_id')->default(1);
            $table->unsignedBigInteger('size_id')->default(1);
            $table->unsignedBigInteger('subcategory_id')->default(1);
            $table->timestamps();
            $table->softDeletes(); // tambien debo indicarlo en el modelo

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
        Schema::dropIfExists('products');
    }
}

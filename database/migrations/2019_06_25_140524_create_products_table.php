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
            $table->string('name',100)->nullable();
            $table->string('short_desc',150)->nullable();
            $table->string('long_desc',250)->nullable();
            $table->decimal('price',6,2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->unsignedBigInteger('color_id')->nullable()->default(1);
            $table->unsignedBigInteger('size_id')->nullable()->default(1);
            $table->unsignedBigInteger('subcategory_id')->nullable()->default(1);
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

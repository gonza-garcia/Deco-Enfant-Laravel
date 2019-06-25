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
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('short_desc',150);
            $table->text('long_desc');
            $table->decimal('price',8,2);
            $table->string('thumbnail');
            $table->integer('stock')->nullable();
            $table->decimal('discount_off',8,2)->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('size_id')->nullable();
            $table->bigInteger('color_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sexes', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name',30);
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
        Schema::dropIfExists('sexes');
    }
}

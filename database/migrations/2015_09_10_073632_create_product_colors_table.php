<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('id_color')->unsigned();
            $table->foreign('id_color')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
            $table->unique(['id_product','id_color']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_colors');
    }
}

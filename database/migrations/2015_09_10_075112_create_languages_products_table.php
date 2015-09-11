<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unique(['id_language','id_product']);
            $table->string('name');
            $table->text('description')->nullable();
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
        Schema::drop('languages_products');
    }
}

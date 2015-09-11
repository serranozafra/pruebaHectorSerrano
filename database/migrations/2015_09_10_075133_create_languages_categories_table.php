<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unique(['id_language','id_category']);
            $table->string('name');
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
        Schema::drop('languages_categories');
    }
}

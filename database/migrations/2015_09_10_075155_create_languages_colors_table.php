<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
            $table->integer('id_color')->unsigned();
            $table->foreign('id_color')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
            $table->unique(['id_language','id_color']);
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
        Schema::drop('languages_colors');
    }
}

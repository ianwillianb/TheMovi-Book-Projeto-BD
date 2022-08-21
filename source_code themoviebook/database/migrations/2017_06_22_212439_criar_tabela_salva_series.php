<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaSalvaSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salvaseries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('serie_id')->unsigned()->index();
            $table->integer('temporada')->unsigned();
            $table->integer('episodio')->unsigned();
            $table->timestamps();

            $table->unique(['user_id', 'serie_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('serie_id')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salvaseries');
    }
}

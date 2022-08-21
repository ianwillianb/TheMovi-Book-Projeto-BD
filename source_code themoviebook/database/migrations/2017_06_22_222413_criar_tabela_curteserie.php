<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCurteserie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curteserie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('serie_id')->unsigned()->index();
            $table->boolean('likeoudislike'); /*0 para dislike, 1 para like*/
            $table->text('review')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('serie_id')->references('id')->on('series');

            $table->unique(['user_id', 'serie_id']);

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
        Schema::dropIfExists('curteserie');
    }
}
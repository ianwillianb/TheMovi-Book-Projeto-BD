<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCurtefilme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curtefilme', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('filme_id')->unsigned()->index();
            $table->boolean('likeoudislike'); // 0 pra dislike 1 pra like
            $table->text('review')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('filme_id')->references('id')->on('filmes');

            $table->unique(['user_id', 'filme_id']);

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
        Schema::dropIfExists('curte');
    }
}

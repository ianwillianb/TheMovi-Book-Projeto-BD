<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRELACAOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacao', function (Blueprint $table) {
            $table->increments('relation_id');
            $table->integer('id_1')->unsigned()->index();
            $table->integer('id_2')->unsigned()->index();
            $table->integer('estado')->default(0)->unsigned();
            $table->integer('action')->default(0)->unsigned(); /* id que realizaou a ultima ação */
            $table->timestamps();

            $table->foreign('id_1')->references('id')->on('users');
            $table->foreign('id_2')->references('id')->on('users');

            $table->unique(['id_1', 'id_2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relacao');
    }
}

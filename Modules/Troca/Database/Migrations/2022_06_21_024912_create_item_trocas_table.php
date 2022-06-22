<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_trocas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_item')->unsigned()->nullable(false);
            $table->integer('id_troca')->unsigned()->nullable(false);

            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('id_troca')->references('id')->on('troca')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_trocas');
    }
};

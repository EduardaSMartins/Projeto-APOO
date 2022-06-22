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
        Schema::create('entregas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_pedido')->unsigned()->nullable(false);
            $table->date('data_efetuacao')->nullable(false);
            $table->date('data_entrega_estimada')->nullable(true);
            $table->enum('status', ['transito','entregue','devolvida','cancelada'])->default('transito');

            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');

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
        Schema::dropIfExists('entregas');
    }
};

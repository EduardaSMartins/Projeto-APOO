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
        Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_item')->unsigned()->nullable(false);
            $table->integer('id_pedido')->unsigned()->nullable(false);

            $table->foreign('id_item')->references('id')->on('items')->onDelete('NO ACTION');
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('NO ACTION');

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
        Schema::dropIfExists('itens_pedidos');
    }
};

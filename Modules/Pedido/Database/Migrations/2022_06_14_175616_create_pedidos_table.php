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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_empresa')->unsigned()->nullable(false);
            $table->dateTime('data_pedido')->nullable(false);
            $table->float('valor_final',8,2)->nullable(false)->default('0.00');
            $table->enum('status', ['aguardando','aprovado','cancelado'])->nullable(false)->default('aguardando');
            $table->text('observacao')->nullable(true);

            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');

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
        Schema::dropIfExists('pedidos');
    }
};

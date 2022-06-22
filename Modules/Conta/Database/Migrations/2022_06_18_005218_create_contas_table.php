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
        Schema::create('contas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_pedido')->unsigned()->nullable(false);
            $table->date('data_vencimento')->nullable(false);
            $table->date('data_efetivacao')->nullable(false);
            $table->float('valor', 8, 2)->nullable(false)->default('0.00');
            $table->string('descricao', 255)->nullable(true);
            $table->integer('numero_parcelas')->nullable(false);
            $table->enum('periodicidade', ['semanal', 'quinzenal', 'mensal'])->default('mensal');
            $table->string('observacao', 255)->nullable(true);

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
        Schema::dropIfExists('contas');
    }
};

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
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_categoria')->unsigned()->nullable(false);
            $table->string('nome', 255)->nullable(false);
            $table->string('descricao', 255)->nullable(true);
            $table->string('codigo_barras', 50)->nullable(false);
            $table->string('codigo_interno', 50)->nullable(false);
            $table->string('sabor', 50)->nullable(true);
            $table->string('cor', 15)->nullable(true);
            $table->string('tamanho', 255)->nullable(true);
            $table->integer('quantidade_minima')->nullable(false);
            $table->integer('quantidade_caixa')->nullable(false);
            $table->integer('quantidade_estoque')->nullable(false);
            $table->float('valor_unitario', 8,2)->nullable(false);

            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');

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
        Schema::dropIfExists('produtos');
    }
};

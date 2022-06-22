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
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_cliente')->unsigned()->nullable(true);
            $table->integer('id_telefone')->unsigned()->nullable(true);
            $table->string('cnpj',20)->nullable(true);
            $table->string('razao_social', 255)->nullable(true);
            $table->string('nome_fantasia', 255)->nullable(true);
            $table->string('ramo_atividade', 255)->nullable(true);
            $table->string('email', 255)->nullable(true);
            $table->enum('porte', ['micro','pequena','media','grande'])->nullable(true);

            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_telefone')->references('id')->on('telefones')->onDelete('cascade');

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
        Schema::dropIfExists('empresas');
    }
};

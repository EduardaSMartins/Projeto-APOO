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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_telefone')->unsigned()->nullable(true);
            $table->string('cpf',15)->nullable(false);
            $table->string('rg',15)->nullable(false);
            $table->string('rg_orgao', 10)->nullable(true);
            $table->string('rg_uf', 10)->nullable(true);
            $table->string('nome', 255)->nullable(true);
            $table->string('sobrenome', 255)->nullable(true);
            $table->string('email', 255)->nullable(true);
            $table->date('data_nascimento')->nullable(true);
            
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
        Schema::dropIfExists('clientes');
    }
};

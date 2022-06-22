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
        Schema::create('trocas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_empresa')->unsigned()->nullable(false);
            $table->date('data_solicitacao')->nullable(false);
            $table->enum('status', ['pendente','aceita','cancelada'])->nullable(false)->default('pendente');

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
        Schema::dropIfExists('trocas');
    }
};

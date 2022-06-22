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
        Schema::create('endereco_empresas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_empresa')->unsigned()->nullable(false);
            $table->integer('id_logradouro')->unsigned()->nullable(false);
            $table->string('complemento', 255)->nullable(true);
            $table->string('numero', 10)->nullable(true)->default(null);

            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('id_logradouro')->references('id')->on('logradouros')->onDelete('cascade');


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
        Schema::dropIfExists('endereco_empresas');
    }
};

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
        Schema::create('logradouros', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_bairro')->unsigned()->nullable(false);
            $table->string('descricao', 255)->nullable(false);
            $table->string('cep', 15)->nullable(false);

            $table->foreign('id_bairro')->references('id')->on('bairros')->onDelete('cascade');

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
        Schema::dropIfExists('logradouros');
    }
};

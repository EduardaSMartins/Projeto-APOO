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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->increments('id')->unsigned()->nullable(false);
            $table->integer('id_conta')->unsigned()->nullable(false);
            $table->date('data_venc')->nullable(false);
            $table->integer('numero_parcela')->default(1);
            $table->date('data_pagamento')->nullable(true);
            $table->boolean('parcela_paga')->nullable(false)->default(0);
            $table->string('observacao', 255)->nullable(true);

            $table->foreign('id_conta')->references('id')->on('contas')->onDelete('NO ACTION');

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
        Schema::dropIfExists('parcelas');
    }
};

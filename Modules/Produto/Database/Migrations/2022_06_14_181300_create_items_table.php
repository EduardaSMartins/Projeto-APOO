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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_produto')->unsigned()->nullable(false);
            // $table->string('nome', 255)->nullable(false);
            $table->integer('quantidade')->nullable(false);
            $table->float('valor', 8,2)->nullable(false);
            $table->float('valor_total', 8,2)->nullable(false);

            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('NO ACTION');

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
        Schema::dropIfExists('items');
    }
};

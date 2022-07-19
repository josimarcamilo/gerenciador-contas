<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuicao', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('orcamento_id')->nullable();
            $table->string('descricao');
            $table->integer('porcentagem');

            $table->foreign('orcamento_id')->references('id')->on('orcamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribuicao');
    }
};

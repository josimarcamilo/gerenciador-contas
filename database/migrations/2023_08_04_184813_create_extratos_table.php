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
        Schema::create('extratos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('orcamento_id');
            $table->smallInteger('tipo');
            $table->string('descricao');
            $table->unsignedInteger('valor');
            $table->smallInteger('status')->nullable();
            $table->foreignId('categoria_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extratos');
    }
};

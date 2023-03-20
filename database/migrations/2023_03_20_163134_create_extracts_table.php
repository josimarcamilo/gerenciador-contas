<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_planning_id');
            $table->smallInteger('type');
            $table->string('description');
            $table->integer('amount');
            $table->integer('category')->nullable();
            $table->smallInteger('status')->nullable();
            $table->timestamp('due_date')->nullable();

            $table->foreign('financial_planning_id')->references('id')->on('financial_plannings');
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
        Schema::dropIfExists('extracts');
    }
};

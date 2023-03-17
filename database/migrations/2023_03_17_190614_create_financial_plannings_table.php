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
        Schema::create('financial_plannings', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid();
            $table->unsignedInteger('financial_area_id');
            $table->string('reference_month');
            $table->unsignedSmallInteger('status');
            $table->foreign('financial_area_id')->references('id')->on('financial_areas');

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
        Schema::dropIfExists('financial_plannings');
    }
};

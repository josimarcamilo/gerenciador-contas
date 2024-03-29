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
        Schema::create('extracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('budget_id')->constrained();
            $table->smallInteger('type');
            $table->string('description');
            $table->unsignedInteger('value');
            $table->smallInteger('status')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            $table->index(['account_id', 'budget_id']);
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

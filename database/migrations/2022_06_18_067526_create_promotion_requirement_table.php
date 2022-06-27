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
        Schema::create('promotion_requirement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promotion');
            $table->unsignedBigInteger('requirement');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('promotion')->references('id')->on('promotion');
            $table->foreign('requirement')->references('id')->on('requirement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_requirement');
    }
};

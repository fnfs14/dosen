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
        Schema::create('major', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college');
            $table->enum('stage', config('data.stage'));
            $table->string('name');
            $table->string('front_degree')->nullable();
            $table->string('back_degree')->nullable();
            $table->timestamps();

            $table->foreign('college')->references('id')->on('college');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('major');
    }
};

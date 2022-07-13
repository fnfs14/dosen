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
        Schema::create('promotion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('position');
            $table->string('file')->nullable();
            $table->bigInteger('time')->comment('created at - last promotion end');
            $table->enum('status', config('data.status.promotion'));
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('position')->references('id')->on('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion');
    }
};

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
        Schema::create('teaching_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('level');
            $table->unsignedBigInteger('major');
            $table->integer('nip')->nullable();
            $table->integer('nidk')->nullable();
            $table->integer('nidn')->nullable();
            $table->integer('karpeg')->nullable();
            $table->enum('employment', config('data.status.employment'));
            $table->enum('activity', config('data.status.activity'));
            $table->enum('certification', config('data.status.certification'));
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('level')->references('id')->on('level');
            $table->foreign('major')->references('id')->on('major');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teaching_history');
    }
};

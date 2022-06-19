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
            $table->integer('nip');
            $table->unsignedBigInteger('user');
            $table->enum('jabatan', config('data.position'));
            $table->enum('major', config('data.major'));
            $table->enum('rank', config('data.rank'));
            $table->enum('level', config('data.level'));
            $table->integer('rate');
            $table->enum('employment', config('data.status.employment'));
            $table->enum('activity', config('data.status.activity'));
            $table->enum('certification', config('data.status.certification'));
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
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

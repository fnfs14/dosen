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
        Schema::create('educational_background', function (Blueprint $table) {
            $table->id();
            $table->integer('nip');
            $table->unsignedBigInteger('user');
            $table->enum('degree', config('data.degree'));
            $table->enum('college', config('data.college'));
            $table->enum('stage', config('data.stage'));
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
        Schema::dropIfExists('educational_background');
    }
};

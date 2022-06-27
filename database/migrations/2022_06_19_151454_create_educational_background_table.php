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
            $table->unsignedBigInteger('major');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('educational_background');
    }
};

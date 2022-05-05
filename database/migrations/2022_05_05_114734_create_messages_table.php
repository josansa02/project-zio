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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->unsignedBigInteger('propietary_id');
            $table->foreign('propietary_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('img_id');
            $table->foreign('img_id')->references('id')->on('images')->onDelete('cascade');
            $table->unsignedBigInteger('writer_id');
            $table->foreign('writer_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
};

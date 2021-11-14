<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->date("day");
            $table->time("time");
            $table->unsignedBigInteger("room_id");
            $table->string("unit");
            $table->string("content");
            $table->integer("duration");
            $table->integer("rate_per_hour");
            $table->integer("rate_for_class");
            $table->integer("comment")->nullable();
            $table->timestamps();
            $table->foreign("room_id")->references("id")->on("rooms");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_log', function (Blueprint $table) {
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("log_id");
            $table->foreign("teacher_id")->references("id")->on("users");
            $table->foreign("log_id")->references("id")->on("logs");
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
        Schema::dropIfExists('teacher_log');
    }
}

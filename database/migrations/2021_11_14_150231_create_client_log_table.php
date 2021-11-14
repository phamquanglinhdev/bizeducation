<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_log', function (Blueprint $table) {
            $table->unsignedBigInteger("client_id");
            $table->unsignedBigInteger("log_id");
            $table->foreign("client_id")->references("id")->on("users");
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
        Schema::dropIfExists('client_log');
    }
}

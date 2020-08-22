<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statementuser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('statement_id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->text('obs')->nullable()->default(NULL);

            $table->timestamps();
            $table->foreign('statement_id')->references('id')->on('statements')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statementuser');
    }
}

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
            $table->string('entity', 100);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('data')->nullable()->default(NULL);
            $table->unsignedBigInteger('user_id')->nullable()->default(NULL);
            $table->enum('type', ['C', 'U', 'D', 'N', 'L']);//Create, Update, Delete, Notification, Login
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('logs');
    }
}

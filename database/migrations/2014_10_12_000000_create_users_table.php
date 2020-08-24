<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lastname', 150)->nullable()->default(NULL);
            //$table->string('email')->unique();
            $table->integer('comitente')->nullable()->default(NULL);
			$table->integer('document_number')->nullable()->default(NULL);
            $table->enum('document_type', ['LC', 'LE', 'DNI', 'CUIT', 'CUIL'])->nullable()->default(NULL);
            $table->string('password');
            $table->enum('profile', ['root', 'adm', 'user']);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}

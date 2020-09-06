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
            $table->string('password');
            $table->enum('profile', ['root', 'adm', 'user']);
            $table->string('tipo', 20)->nullable()->default(NULL);
            $table->string('comitente', 20)->nullable()->default(NULL);
            $table->string('nombre', 200);
            $table->string('domicilio', 200)->nullable()->default(NULL);
            $table->string('post', 20)->nullable()->default(NULL);
            $table->text('localidad')->nullable()->default(NULL);
            $table->string('pais', 20)->nullable()->default(NULL);
            $table->string('telefono', 100)->nullable()->default(NULL);
            $table->string('cuit', 30)->nullable()->default(NULL);
            $table->string('docu', 5)->nullable()->default(NULL);
            $table->string('numero_doc', 30)->nullable()->default(NULL);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->tinyInteger('user_creador_id')->unsiged()->nullable();
            $table->string('web');
            $table->string('direccion');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('registration_token')->nullable();
            $table->integer('type_user_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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

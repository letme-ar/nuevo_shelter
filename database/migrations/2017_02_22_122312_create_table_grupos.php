<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->tinyInteger('estilo_id')->unsiged();
            $table->string('integrantes',100)->nullable();
            $table->string('web',50)->nullable();
            $table->string('facebook',50)->nullable();
            $table->string('twitter',30)->nullable();
            $table->string('instagram',50)->nullable();
            $table->string('youtube',50)->nullable();
            $table->string('vimeo',50)->nullable();
            $table->string('bandcamp',50)->nullable();
            $table->string('spotify',50)->nullable();
            $table->tinyInteger('user_creador_id')->unsiged();
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
        Schema::dropIfExists('grupos');
    }
}

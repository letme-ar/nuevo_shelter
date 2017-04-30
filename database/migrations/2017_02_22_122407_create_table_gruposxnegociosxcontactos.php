<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGruposxnegociosxcontactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gruposxnegociosxcontactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupoxnegocio_id')->unsiged();
            $table->string('nombre',50);
            $table->string('telefono',30);
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
        Schema::dropIfExists('gruposxnegociosxcontactos');
    }
}

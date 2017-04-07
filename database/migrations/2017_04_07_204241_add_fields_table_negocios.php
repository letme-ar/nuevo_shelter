<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTableNegocios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negocios', function (Blueprint $table) {
            $table->string('mail')->after('descripcion');
            $table->string('path_foto')->after('mail');
            $table->string('web')->after('path_foto');
            $table->string('facebook')->after('web');
            $table->string('twitter')->after('facebook');
            $table->string('instagram')->after('twitter');
            $table->string('direccion')->after('instagram');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

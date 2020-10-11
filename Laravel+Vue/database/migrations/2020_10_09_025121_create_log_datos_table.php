<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('dev_id');
            $table->foreign('dev_id')->references('id')->on('disp_aceptados');
            $table->bigInteger('temperatura');
            $table->bigInteger('humedad');
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_datos');
    }
}

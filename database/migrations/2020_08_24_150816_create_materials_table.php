<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('modelo');
            $table->text('caracteristicas')->nullable();
            $table->bigInteger('cantidad_total');
            $table->bigInteger('cantidad_prestamo')->nullable();
            $table->date('fecha')->nullable();
            $table->string('imagen')->nullable();
            $table->string('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}

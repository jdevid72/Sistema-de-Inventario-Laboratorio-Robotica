<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('ci')->unique();
            $table->string('cu')->unique();
            $table->bigInteger('tipo_id');
            $table->text('direccion')->nullable();
            $table->bigInteger('telefono')->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('perfil')->nullable();
            $table->string('nombre_respaldo');
            $table->bigInteger('telefono_respaldo')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}

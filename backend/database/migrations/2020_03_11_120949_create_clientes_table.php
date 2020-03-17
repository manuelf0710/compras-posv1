<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nombre', 150);
			$table->bigInteger('documento');
			$table->string('email', 200)->nullable();
			$table->string('telefono', 100)->nullable();
			$table->string('direccion', 120)->nullable();
			$table->date('fecha_nacimiento')->nullable();
			$table->integer('compras')->default(0);
			$table->dateTime('ultima_compra')->nullable();
			$table->dateTime('fecha_ingreso');
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
        Schema::dropIfExists('clientes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecioListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_listas', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->Integer('producto_id')->unsigned()->comment('fk producto.id');
			$table->string('nombre',50);
			$table->float('porcentaje', 6,2);
			$table->float('valor', 10,2);
			$table->float('ganancia', 10,2);
			$table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('precio_listas');
    }
}

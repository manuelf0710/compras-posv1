<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('producto_id')->unsigned();
			$table->integer('venta_id')->unsigned();
			$table->integer('cantidad');
			$table->float('precio_unitario', 10,2);
			$table->float('precio_total', 11,2);
            $table->timestamps();
			$table->softDeletes();
			$table->foreign('producto_id')->references('id')->on('productos');
			$table->foreign('venta_id')->references('id')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_ventas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->Integer('codigo_factura')->unsigned()->comment('codigo de la factura');
			$table->Integer('cliente_id')->unsigned()->comment('fk clientes.id');
			$table->Integer('vendedor_id')->unsigned()->comment('fk usuarios.id');
			$table->Integer('comision_id')->unsigned()->comment('fk usuarios.id');
			$table->Integer('porcentaje_comision')->default(0);
			$table->float('impuesto', 10,2);
			$table->float('neto', 10,2);
			$table->float('total', 11,2);
			$table->text('metodo_pago');
			$table->softDeletes();
			$table->timestamps();
			$table->foreign('cliente_id')->references('id')->on('clientes');			
			$table->foreign('vendedor_id')->references('id')->on('usuarios');			
			$table->foreign('comision_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}

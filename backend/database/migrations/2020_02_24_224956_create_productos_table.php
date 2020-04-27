<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
			$table->Integer('categoria_id')->unsigned()->comment('fk categorias.id');
			$table->string('codigo',100)->unique();
			$table->text('descripcion');
			$table->text('imagen')->nullable();
			$table->Integer('stock');
			$table->float('precio_compra', 10,2);
			$table->float('precio_venta', 10,2);
			$table->Integer('ventas')->default(0);
			$table->Integer('porcentaje')->default(0)->comment('porcentaje impuesto');
            $table->timestamps();
			$table->softDeletes();
			$table->foreign('categoria_id')->references('id')->on('categorias');
				//->onDelete('cascade')
				//->onUpdate('cascade')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

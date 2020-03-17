<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reqs', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('viaticos')->nullable()->comment('campo manejar viaticos 1 autoriza da 2 autoriza rector 3 autorizado');
			$table->integer('modalidad')->default(-1)->comment('modalidad');
			$table->integer('clasificacion')->default(-1)->comment('clasificacion');
			$table->text('descripcion');
			$table->string('cantidad',10);
			$table->text('justificacion');
			$table->text('observacion');
			$table->tinyInteger('seleccionado')->comment('0 no seleccionado 1 seleccionado');
			$table->integer('requerimiento_id')->comment('codigo requerimiento');
			$table->tinyInteger('aprobado')->comment('1 aprobado, 2 no');
			$table->tinyInteger('unidad_medida_id')->comment('foranea de unidad de medida');
			$table->tinyInteger('consejo_superior')->comment('0 no 1 consejo superior');
			$table->tinyInteger('comite_tecnologico')->comment('0 no 1 comite tecnologico');
			$table->tinyInteger('comite_infraestructura')->comment('0 no 1 comite infraestructura');
			$table->integer('poa');
			$table->integer('subpoa');
			$table->string('otro',100)->comment('otro poa');
			$table->tinyInteger('no_tiene_poa')->default(0)->comment('no tiene poa requiere de campo otros obligatorio 0 no 1 si');
			$table->float('valor_presupuesto',10,2)->comment('valor del presupuesto');
			$table->tinyInteger('tipo')->comment('codigo consecutivo de tipo orden compra');
			$table->integer('codigo_orden')->default(0)->comment('codigo de orden compra');
			$table->integer('lista_orden_convenio')->default(0)->comment('listado de ordenes de convenio');
			$table->integer('codigo_orden_menor_cuantia')->default(0)->comment('listado de ordenes de convenio');
			$table->tinyInteger('marca_nocotiza')->comment('marca no cotiza');
			$table->string('proveedor',15)->comment('codigo consecutivo del proveedor');
			$table->integer('convenio_prod')->comment('CODIGO DEL ID CONV_PROD');
			$table->string('mensaje_proveedor_asignado',200)->comment('mensaje proveedor asignado');
			$table->string('proveedor2',15)->comment('codigo de proveedor anterior recotizado devuelto');
			$table->text('descripcioncomp')->comment('descripcion ingresada en comparar.php');
			$table->tinyInteger('cantidad_recotizado')->comment('cantidad de veces recotizado');
			$table->tinyInteger('firma')->comment('0 sin firma 1 preaprobado 2 aprobado rector');
			$table->dateTime('f_firmado_rector')->nullable()->comment('fecha firmado rector');
			$table->string('proveedor_asignado_rector')->omment('proveedor asignado rector');
			$table->dateTime('f_recibido_aux_adm')->nullable()->comment('fecha recibido auxiliar administrativo');
			$table->dateTime('f_recibido_solicitante')->nullable()->comment('fecha recibido persona que solicito requerimiento');
			$table->dateTime('f_firma_orden_compra')->nullable()->comment('echa firma orden compra rector campo orden_compra.ORCOFIRM actualizado con codigo de firma');			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_reqs');
    }
}

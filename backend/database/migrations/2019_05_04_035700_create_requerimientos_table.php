<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimientos', function (Blueprint $table) {
            /*$table->bigIncrements('REQUCODI');
			$table->string('REQUCORE',15)->nullable();
			$table->integer('REQUIDUS')->unsigned();
			$table->integer('REQUAREA')->nullable();
			$table->integer('REQUESTA')->default(1);
			$table->integer('REQUPOA')->nullable();
			$table->integer('REQUSUPO')->nullable();
			$table->dateTime('REQUFESO');
			$table->dateTime('REQUFEEN')->nullable();
			$table->dateTime('REQUFREE')->nullable();
			$table->dateTime('REQUFERE')->nullable();
			$table->string('REQUPERE',20);
			$table->dateTime('REQUFENR')->nullable();
			$table->string('REQUPENR',20);
			$table->dateTime('REQUFEAP')->nullable();
			$table->string('REQUPEAP',20);
			$table->dateTime('REQUFECO')->nullable();
			$table->string('REQUPECO',20);		
			$table->date('REQUFEET')->nullable();
			$table->integer('REQUENCU');
			$table->dateTime('REQUFEFI')->nullable();			
            $table->integer('REQUFLED');
			$table->string('REQUEVEN',50)->nullable();	*/	
            $table->bigIncrements('id')->comment('codigo del requerimiento');
			$table->string('codigo_requ',15)->nullable()->comment('codigo requerimiento');
			$table->integer('usuario_id')->unsigned()->comment('id usuario solicitante');
			$table->integer('area_id')->nullable()->comment('id del area poa');
			$table->integer('estado_id')->default(1)->comment('codigo del estado');
			$table->integer('poa_id')->nullable()->comment('poa');
			$table->integer('subpoa_id')->nullable()->comment('subpoa');
			$table->dateTime('f_solicitud')->comment('f_solicitado');
			$table->dateTime('f_enviado')->nullable();
			$table->dateTime('f_reenviado')->nullable();
			$table->dateTime('f_recibido')->nullable();
			$table->string('persona_recibe_id',20);
			$table->dateTime('f_norecibido')->nullable();
			$table->string('persona_norecibido_id',20);
			$table->dateTime('f_aprobado')->nullable();
			$table->string('persona_aprueba_id',20);
			$table->dateTime('f_cotizacion')->nullable();
			$table->string('persona_cotiza_id',20);		
			$table->date('f_entrega')->nullable();
			$table->integer('encuesta')->comment('0 sin encuesta 1 con encuesta');
			$table->dateTime('f_finalizado')->nullable();			
            $table->integer('permite_editar')->default(0)->comment('permite editar o ingresar un detalle a un requ. (1 activado, 0 desactivado)');
			$table->string('evento_codigo',50)->nullable();			
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
        Schema::dropIfExists('requerimientos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulolinks', function (Blueprint $table) {
            $table->increments('id');
			$table->tinyInteger('modulo')->comment('fk modulos.id');
			$table->string('page',50)->comment('nombre del link');
			$table->string('url',30)->comment('url del link');
			$table->tinyInteger('estado')->default(1)->comment('1 activo, 2 inactivo');
			$table->foreign('modulo')->references('id')->on('modulos');
			$table->tinyInteger('padre')->nullable()->comment('submenu del link referencia esta misma tabla id');
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
        Schema::dropIfExists('modulolinks');
    }
}

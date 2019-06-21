<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('beneficiario');
            $table->string('tipo_dni');
            $table->string('dni');
            $table->string('num_cuenta');
            $table->string('tipo_cuenta');
            $table->integer('tienda_id')->unsigned();
            
            $table->foreign('tienda_id')
                ->references('id')->on('tiendas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
}

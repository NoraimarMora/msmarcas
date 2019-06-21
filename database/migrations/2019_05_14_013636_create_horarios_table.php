<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('dia', [1, 2, 3, 4, 5, 6, 7]);
            $table->integer('abierto');
            $table->integer('cerrado');
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
        Schema::dropIfExists('horarios');
    }
}

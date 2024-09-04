<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('nro_pedido')->unique();
            $table->timestamp('fecha_pedido');
            $table->timestamp('fecha_recepcion');
            $table->timestamp('fecha_despacho');
            $table->timestamp('fecha_entrega');
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_repartidor');
            $table->unsignedBigInteger('estado');
            $table->timestamps();

            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_repartidor')->references('id')->on('users');
            $table->foreign('estado')->references('status_id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_mov')->nullable();
            $table->boolean('tipo_mov')->nullable()->default(false);
            $table->integer('cantidad_mov');
            $table->dateTime('fecha_mov');
            $table->bigInteger('productos_id_pro')->unsigned();
            $table->bigInteger('usuarios_id_usu')->unsigned();
            $table->timestamps();

            $table->foreign('productos_id_pro')->references('id_pro')->on('productos')->onDelete('cascade');
            $table->foreign('usuarios_id_usu')->references('id_usu')->on('usuarios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

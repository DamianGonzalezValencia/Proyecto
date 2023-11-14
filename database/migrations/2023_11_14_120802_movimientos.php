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
            $table->string('tipo_mov');
            $table->integer('cantidad_mov');
            $table->string('fecha_mov');
            $table->string('nombre_mov');
            $table->bigInteger('users_id')->unsigned();
            $table->string('descripcion_mov');
            $table->string('categorias_mov');
            $table->string('marcas_mov');
            $table->string('modelos_mov');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

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

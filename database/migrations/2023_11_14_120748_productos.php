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
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_pro')->nullable();
            $table->string('nombre_pro');
            $table->string('descripcion_pro');
            $table->integer('cantidad_pro');
            $table->bigInteger('categorias_id_cat')->unsigned();
            $table->bigInteger('marcas_id_mar')->unsigned();
            $table->bigInteger('modelos_id_mod')->unsigned();
            $table->timestamps();

            $table->foreign('categorias_id_cat')->references('id_cat')->on('categorias')->onDelete('cascade');
            $table->foreign('marcas_id_mar')->references('id_mar')->on('marcas')->onDelete('cascade');
            $table->foreign('modelos_id_mod')->references('id_mod')->on('modelos')->onDelete('cascade');
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

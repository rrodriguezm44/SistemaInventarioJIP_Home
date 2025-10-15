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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('proveedor_id')->constrained('proveedors')->onDelete('cascade');
            $table->string('codigo_lote');
            $table->date('fecha_entrada');
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('cantidad_inicial');
            $table->integer('cantidad_actual');
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->boolean('estado')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};

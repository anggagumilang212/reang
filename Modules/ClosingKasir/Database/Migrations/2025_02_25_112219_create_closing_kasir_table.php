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
        Schema::create('closing_kasir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id'); // ID Cabang
            $table->date('tanggal'); // Tanggal closing
            $table->decimal('total_penjualan', 15, 2); // Total penjualan
            $table->decimal('total_pengeluaran', 15, 2); // Total pengeluaran
            $table->decimal('selisih_manual', 15, 2)->default(0); // Input manual selisih
            $table->decimal('total_setoran', 15, 2); // Total yang disetorkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closing_kasir');
    }
};

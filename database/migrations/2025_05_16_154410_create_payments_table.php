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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('orders')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['cash', 'QRIS', 'Debit']);
            $table->enum('status_pembayaran', ['belum bayar', 'lunas'])->default('belum bayar'); // atau enum
            $table->decimal('total_bayar', 10, 2);
            $table->dateTime('waktu_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

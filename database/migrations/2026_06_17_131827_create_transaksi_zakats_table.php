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
        Schema::create('transaksi_zakats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('muzakki_id')->constrained('muzakkis')->cascadeOnDelete();
            $table->enum('jenis_zakat', ['Zakat Fitrah', 'Zakat Mal', 'Infak', 'Sedekah']);
            $table->decimal('nominal', 15, 2);
            $table->enum('metode_pembayaran', ['Tunai', 'Transfer Bank', 'E-Wallet']);
            $table->date('tanggal_bayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_zakats');
    }
};

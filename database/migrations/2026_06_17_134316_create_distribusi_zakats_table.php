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
        Schema::create('distribusi_zakats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_distribusi')->unique();
            $table->foreignId('mustahik_id')->constrained('mustahiks')->cascadeOnDelete();
            $table->decimal('nominal_distribusi', 15, 2);
            $table->date('tanggal_distribusi');
            $table->enum('kategori_bantuan', ['Zakat Fitrah', 'Zakat Mal', 'Bantuan Pendidikan', 'Bantuan Kesehatan', 'Bantuan Sosial', 'Bantuan Darurat']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_zakats');
    }
};

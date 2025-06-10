<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bagi_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kegiatan')->constrained('kegiatans')->onDelete('cascade'); // kelahiran ternak
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // peternak
            $table->integer('total_tagihan')->default(250000); // harga anak domba
            $table->integer('jumlah_dibayar')->default(0); // total yang sudah dibayar
            $table->enum('status', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagi_hasils');
    }
};

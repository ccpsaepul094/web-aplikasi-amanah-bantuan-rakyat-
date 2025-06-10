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
        Schema::create('ternaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('induk_id')->nullable()->constrained('ternaks')->onDelete('set null'); // Relasi ke induk (jika ada)
            $table->string('nama')->nullable(); // Nama atau tag telinga
            $table->string('foto_ternak')->nullable();
            $table->string('jns_ternak'); // Contoh: domba
            $table->enum('jns_kelamin', ['jantan', 'betina'])->nullable();
            $table->date('tgl_lahir')->nullable(); // Tanggal lahir anak
            $table->integer('umur_ternak')->default(0); // Diisi otomatis dari tgl_lahir (optional)
            $table->enum('kesehatan', ['sehat', 'sakit']);
            $table->enum('status', ['hidup', 'mati']);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ternaks');
    }
};

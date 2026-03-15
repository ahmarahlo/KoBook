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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('judul');
            $table->string('penulis');
            $table->string('isbn')->nullable();
            $table->enum('genre', ['fiksi', 'non-fiksi', 'self-improvement', 'teknologi', 'bisnis', 'sastra', 'lainnya']);
            $table->string('cover')->nullable();
            $table->integer('jumlah_eksemplar')->default(1);
            $table->integer('stok_tersedia')->default(1);
            $table->enum('status', ['available', 'borrowed', 'reserved', 'maintenance'])->default('available');
            $table->string('lokasi_rak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

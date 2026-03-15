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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Member
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->foreignId('librarian_id')->constrained('users')->cascadeOnDelete(); // Pustakawan
            $table->date('tanggal_pinjam');
            $table->date('tanggal_deadline');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('kondisi_kembali', ['baik', 'sedikit_rusak', 'rusak_berat', 'hilang'])->nullable();
            $table->integer('denda')->default(0);
            $table->enum('status', ['active', 'returned', 'overdue', 'lost'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};

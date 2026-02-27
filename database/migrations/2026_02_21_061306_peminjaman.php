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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
            
            $table->date('loan_date'); 
            $table->date('due_date'); 
            $table->enum('status', ['pending', 'active', 'returned', 'overdue'])->default('pending');
            
            $table->timestamps();
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

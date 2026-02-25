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
    Schema::create('buku', function (Blueprint $table) {
        $table->id();
        $table->string('code', 20)->unique();
        $table->string('title');
        $table->string('author');
        $table->string('publisher')->nullable();
        $table->year('publication_year');
        $table->text('synopsis')->nullable();
        $table->integer('stock')->default(0); 
        $table->string('cover_image')->nullable(); 
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

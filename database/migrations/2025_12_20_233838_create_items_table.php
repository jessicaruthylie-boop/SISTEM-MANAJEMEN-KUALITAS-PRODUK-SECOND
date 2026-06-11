<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Syarat: user_id
        $table->string('nama_barang'); // Kolom 1
        $table->string('brand');       // Kolom 2
        $table->string('kategori');    // Kolom 3
        $table->char('grade', 1);      // Kolom 4 (A/B/C/D)
        $table->integer('harga');
        $table->integer('stok');
        $table->timestamps();          // Syarat: timestamps
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom user_id untuk melacak Admin pembuat data (Syarat Teknis)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->text('description');
            $table->char('grade', 1); // A, B, C, D
            $table->string('location');
            $table->integer('stock');
            $table->decimal('price', 15, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
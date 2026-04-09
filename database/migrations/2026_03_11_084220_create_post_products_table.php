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
        Schema::create('post_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_type');
            $table->decimal('price', 10, 2);
            $table->string('used_for')->nullable();
            $table->string('condition'); // New, Used - Excellent, Used - Good, etc.
            $table->text('description')->nullable();
            $table->string('contact_number');
            $table->string('product_image')->nullable();
            $table->string('status')->default('available'); // available, sold, pending
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_products');
    }
};

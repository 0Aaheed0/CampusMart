<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User making the report
            $table->unsignedBigInteger('product_id')->nullable(); // Product being reported
            $table->unsignedBigInteger('reported_user_id')->nullable(); // User being reported
            $table->enum('report_type', ['product', 'user', 'other'])->default('product');
            $table->string('reason'); // e.g., "Fake Product", "Spam", "Harassment", etc.
            $table->text('description'); // Detailed explanation
            $table->enum('status', ['pending', 'reviewed', 'resolved', 'dismissed'])->default('pending');
            $table->text('admin_notes')->nullable(); // Admin response/notes
            $table->unsignedBigInteger('admin_id')->nullable(); // Admin who reviewed
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('post_products')->onDelete('cascade');
            $table->foreign('reported_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            // Indexes for quick filtering
            $table->index('status');
            $table->index('report_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

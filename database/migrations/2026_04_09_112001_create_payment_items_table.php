<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('seller_id');
            $table->decimal('price', 12, 2);
            $table->string('product_name');
            $table->text('product_details')->nullable();
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('post_products')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};

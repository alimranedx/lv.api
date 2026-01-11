<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates product_images table without foreign key constraints.
     * Used when relationship integrity is handled at application level.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')
                ->comment('Product ID (no foreign key)');
            $table->integer('serial_no')
                ->default(1)
                ->comment('Image display order');
            $table->string('image', 255)
                ->comment('Product image path');
            $table->timestamps();
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the product_images table.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};

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
        Schema::create('gst_bill_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gst_bill_id')->nullable();
            $table->foreign('gst_bill_id')->references('id')->on('gst_bills');
            $table->longText('description')->nullable();
            $table->decimal('total_amount', 15,2)->nullable();
            $table->decimal('cgst_rate', 5,2)->nullable();
            $table->decimal('cgst_amount', 15,2)->nullable();
            $table->decimal('sgst_rate', 5,2)->nullable();
            $table->decimal('sgst_amount', 15,2)->nullable();
            $table->decimal('igst_rate', 5,2)->nullable();
            $table->decimal('igst_amount', 15,2)->nullable();
            $table->decimal('tax_amount', 15,2)->nullable();
            $table->decimal('discount_rate', 5,2)->nullable();
            $table->decimal('discount_amount', 15,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gst_bill_items');
    }
};

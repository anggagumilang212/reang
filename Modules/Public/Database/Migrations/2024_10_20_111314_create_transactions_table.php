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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('midtrans_payment_type')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

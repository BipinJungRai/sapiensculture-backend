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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname')->nullable();
            $table->string('phone_number');
            $table->string('email');          
            $table->string('sub_total');
            $table->string('grand_total');
            $table->string('delivery_address');
            $table->float('delivery_fee');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->string('order_id_from_paypal')->nullable();
            $table->enum('status', ['ordered', 'pending', 'delivered', 'cancelled'])->default('ordered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

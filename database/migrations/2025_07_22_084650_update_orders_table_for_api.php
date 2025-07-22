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
        Schema::table('orders', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn([
                'firstName',
                'lastName',
                'email',
                'address',
                'orderDate',
                'shoe_name',
                'price',
                'quantity',
                'payment_type'
            ]);

            // Add new columns
            $table->decimal('total_amount', 10, 2)->after('user_id');
            $table->text('shipping_address')->after('total_amount');
            $table->string('payment_method')->after('phone');
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending')->after('payment_method');
            $table->string('payment_transaction_id')->nullable()->after('payment_status');
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending')->after('payment_transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add back old columns
            $table->string('firstName')->after('user_id');
            $table->string('lastName')->after('firstName');
            $table->string('email')->after('lastName');
            $table->string('address')->after('phone');
            $table->string('orderDate')->after('address');
            $table->string('shoe_name')->after('orderDate');
            $table->string('price')->after('shoe_name');
            $table->integer('quantity')->after('price');
            $table->string('payment_type')->after('quantity');

            // Drop new columns
            $table->dropColumn([
                'total_amount',
                'shipping_address',
                'payment_method',
                'payment_status',
                'payment_transaction_id',
                'order_status'
            ]);
        });
    }
};

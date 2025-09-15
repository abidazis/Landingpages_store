<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_create_orders_table.php
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_contact'); // Untuk nomor WA
            $table->date('order_date');
            $table->enum('status', ['Baru', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Baru');
            $table->text('notes')->nullable();
            $table->integer('total_amount')->default(0); // Total harga pesanan
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

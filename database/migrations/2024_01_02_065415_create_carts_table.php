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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shoe_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('shoe_name');
            $table->string('shoe_model');
            $table->string('size');
            $table->unsignedInteger('quantity')->default(1);
            $table->string('price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

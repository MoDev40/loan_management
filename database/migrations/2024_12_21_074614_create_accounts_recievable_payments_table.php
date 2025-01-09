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
        Schema::create('accounts_receivable_payments', function (Blueprint $table) {
            $table->id();
            $table->string('amount', 15, 2);
            $table->foreignId('accounts_receivable_id')->constrained('accounts_receivable')->onDelete('cascade');
            $table->dateTime('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts_receivable_payments');
    }
};

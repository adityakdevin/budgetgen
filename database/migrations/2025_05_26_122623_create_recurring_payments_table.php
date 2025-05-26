<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recurring_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->integer('amount');
            $table->integer('tenure_months')->nullable();
            $table->integer('total_amount')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('auto_debit')->default(false);
            $table->foreignId('linked_credit_card_id')->nullable()->constrained('credit_cards')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recurring_payments');
    }
};

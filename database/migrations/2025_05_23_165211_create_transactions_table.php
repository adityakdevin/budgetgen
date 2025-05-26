<?php

use App\Enums\TransactionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('type')->default(TransactionType::EXPENSE);
            $table->bigInteger('amount');
            $table->dateTime('transaction_date');
            $table->string('counterparty')->nullable();
            $table->string('payment_mode')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_frequency')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('status')->default('cleared');
            $table->jsonb('tags')->nullable();
            $table->nullableMorphs('linked_entity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

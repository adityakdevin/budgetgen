<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recurring_payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recurring_payment_id')->constrained('recurring_payments');
            $table->date('due_date');
            $table->integer('amount');
            $table->boolean('paid')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recurring_payment_schedules');
    }
};

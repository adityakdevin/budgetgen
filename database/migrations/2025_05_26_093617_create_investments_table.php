<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('investment_type');
            $table->string('name');
            $table->string('provider')->nullable();
            $table->string('account_no')->nullable();
            $table->integer('amount_invested');
            $table->integer('current_value')->nullable();
            $table->integer('expected_return_rate')->nullable();
            $table->date('start_date');
            $table->date('maturity_date')->nullable();
            $table->string('mode');
            $table->string('frequency')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();

            $table->enum('tax_section', ['80C', '80D', 'None'])->nullable();
            $table->enum('risk_level', ['low', 'medium', 'high'])->nullable();
            $table->foreignId('goal_id')->nullable()->constrained('goals')->nullOnDelete();
            $table->boolean('is_auto_trackable')->default(false);
            $table->jsonb('tags')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};

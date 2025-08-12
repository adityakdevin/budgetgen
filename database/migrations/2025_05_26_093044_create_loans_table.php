<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('provider');
            $table->string('account_no')->nullable();
            $table->string('type');
            $table->integer('principal_amount');
            $table->integer('interest_rate')->nullable();
            $table->integer('emi_amount');
            $table->unsignedSmallInteger('total_emis');
            $table->unsignedSmallInteger('emis_paid')->default(0);
            $table->date('start_date');
            $table->date('next_emi_due');
            $table->boolean('autopay')->default(false);
            $table->string('status')->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('credit_card_dues', function (Blueprint $table) {
            $table->integer('min_due_amount')
                ->after('due_amount')
                ->default(0);
        });
    }
};

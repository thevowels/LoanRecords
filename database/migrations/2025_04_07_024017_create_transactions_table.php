<?php

use App\Models\Debt;
use App\Models\User;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('debt_id');
            $table->foreign('debt_id')->references('id')->on('debts')->onDelete('restrict');
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->enum('type',['loan', 'return'])->default('loan');
            $table->integer('amount')->default(0);
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

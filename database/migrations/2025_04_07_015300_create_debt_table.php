<?php

use App\Models\Consumer;
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
        Schema::create('debts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('currency', ['kyat', 'baht'])->default('kyat');
            $table->foreignIdFor(Consumer::class);
            $table->integer('amount')->default(0);
            $table->integer('limit')->default(10000);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['consumer_id', 'currency']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debt');
    }
};

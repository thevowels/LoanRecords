<?php

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
        Schema::create('user_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->restrictOnDelete();
            $table->enum('currency', ['kyat', 'baht']);
            $table->unsignedBiteger('limit');
            $table->unique(['user_id', 'currency']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_limits');
    }
};

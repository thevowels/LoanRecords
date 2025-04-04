<?php

use App\Models\User;
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
        Schema::create('bahts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Consumer::class)->constrained()->restrictOnDelete();
            $table->boolean('is_loan')->default(true);
            $table->unsignedBigInteger('amount');
            $table->string('comment')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahts');
    }
};

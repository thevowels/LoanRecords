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
        Schema::create('consumers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(User::class);
            $table->string('email')->unique()->nullable();
            $table->string('phone');

            $table->string('identification_type')->nullable();
            $table->string('identification_number');

            $table->string('country');
            $table->string('city');


            $table->unsignedBigInteger('amount')->default(0)->nullable();

            $table->softDeletes();

//            $table->string('photo_path', 2048)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumers');
    }
};

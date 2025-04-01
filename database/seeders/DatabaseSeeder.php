<?php

namespace Database\Seeders;

use App\Models\Consumer;
use App\Models\User;
use App\Models\Baht;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();
        $consumers = Consumer::factory(10)->recycle($users)->create();

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $testUserConsumers =  Consumer::factory(30)->for($testUser)->create();

        Baht::factory(30)->recycle($consumers)->recycle($users)->create();




    }
}

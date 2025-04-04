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
        $consumers = Consumer::factory(50)->recycle($users)->create();
//
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $testUserConsumers =  Consumer::factory(20)->for($testUser)->create();
            $adminUserConsumers =  Consumer::factory(20)->for($adminUser)->create();

//        Baht::factory(100)->recycle($consumers)->create();
//        Baht::factory(100)->recycle($testUserConsumers)->create();




    }
}

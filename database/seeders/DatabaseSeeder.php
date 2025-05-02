<?php

namespace Database\Seeders;

use App\Models\Consumer;
use App\Models\Debt;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLimit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::all()->each(function ($user) {
            UserLimit::create(['user_id' => $user->id, 'currency' => 'kyat', 'limit' => 300000]);
            UserLimit::create(['user_id' => $user->id, 'currency' => 'baht', 'limit' => 10000]);
        });

                $users = User::factory(5)->create();
                $consumers = Consumer::factory(20)->recycle($users)->create();


                $testUserConsumers =  Consumer::factory(10)->for($testUser)->create();
                $adminUserConsumers =  Consumer::factory(10)->for($adminUser)->create();

                $start = Carbon::now()->subMonths(1)->startOfMonth();
                $end = Carbon::now();

                foreach( Consumer::all() as $consumer) {
                    Debt::create([
                        'consumer_id' => $consumer->id,
                        'created_at' => $start->copy(),
                        'currency' => 'kyat',
                        'amount' => 0,
                        'limit' => rand(1000000,3000000)
                    ]);
                    Debt::create([
                        'consumer_id' => $consumer->id,
                        'created_at' => $start->copy(),
                        'currency' => 'baht',
                        'amount' => 0,
                        'limit' => rand(200000,500000)
                    ]);
                }


                while($start->lte($end)) {
                    foreach( Debt::where('currency','baht')->get() as $debt) {
                        $amount = rand(500,1000);
                        Transaction::factory(3)->create([
                            'debt_id' => $debt->id,
                            'user_id' => 1,
                            'type' => 'loan',
                            'currency' => $debt->currency,
                            'amount' => $amount,
                            'comment' => fake()->realText(20),
                            'created_at' => $start->copy(),
                            'updated_at' => $start->copy(),

                        ]);
                        Transaction::factory(2)->create([
                            'debt_id' => $debt->id,
                            'user_id' => 1,
                            'type' => 'return',
                            'currency' => $debt->currency,
                            'amount' => $amount,
                            'comment' => fake()->realText(20),
                            'created_at' => $start->copy(),
                            'updated_at' => $start->copy(),

                        ]);
                        Transaction::factory()->create([
                            'debt_id' => $debt->id,
                            'user_id' => 1,
                            'type' => 'return',
                            'currency' => $debt->currency,
                            'amount' => rand(1,400),
                            'comment' => fake()->realText(20),
                            'created_at' => $start->copy(),
                            'updated_at' => $start->copy(),

                        ]);

                    }
                    foreach( Debt::where('currency','kyat')->get() as $debt) {
                        Transaction::factory(2)->create([
                            'debt_id' => $debt->id,
                            'user_id' => 1,
                            'type' => 'loan',
                            'currency' => $debt->currency,
                            'amount' => rand(1000, 10000),
                            'comment' => fake()->realText(20),
                            'created_at' => $start->copy(),
                            'updated_at' => $start->copy(),

                        ]);
                        Transaction::factory(2)->create([
                            'debt_id' => $debt->id,
                            'user_id' => 1,
                            'type' => 'return',
                            'currency' => $debt->currency,
                            'amount' => rand(1, 1000),
                            'comment' => fake()->realText(20),
                            'created_at' => $start->copy(),
                            'updated_at' => $start->copy(),

                        ]);

                    }

                    $start->addDay();
                }

    }
}

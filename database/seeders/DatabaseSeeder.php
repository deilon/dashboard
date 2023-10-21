<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ======= Users =======
        // \App\Models\User::factory(15)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ======= SubscriptionPlan & SubscriptionTier =======
        // \App\Models\SubscriptionPlan::factory(1)->create();
        \App\Models\SubscriptionTier::factory(1)->create();
    }
}

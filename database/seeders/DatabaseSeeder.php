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
        \App\Models\User::factory()->create([
            'name' => 'Bruno Costa',
            'email' => 'bhcosta90@gmail.com',
            'password' => '$2y$10$jiiwk.Hr/8eTWTe4NLOC3eGwocGWteM576nN6Sk0Wk6tURtkFnDpK	',
        ]);

        $this->call(PlanSeeder::class);
        $this->call(UserPlanSeeder::class);
        $this->call(FeatureSeeder::class);
    }
}

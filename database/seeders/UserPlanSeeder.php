<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::get() as $user) {
            $user->plan()->create([
                'plan_id' => 1,
                'status'  => 'ACTIVE',
                'date_subscription' => '2023-07-25 16:06:55',
                'reference_transaction' => '7F35AA248383361884CABF818F039A87',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'plan_id' => 1,
            'name' => 'Feature teste',
            'slug' => 'feature-test',
            'type' => 'amount',
            'rule' => ['amount' => 10],
        ]);
    }
}

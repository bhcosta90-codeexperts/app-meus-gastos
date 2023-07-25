<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::factory()->create([
            'slug' => 'teste2',
            'description' => 'teste2',
            'price' => 139 / 100,
            'reference' => '655EAF06E7E7D16224BC3F8B5AA91242'
        ]);
        Plan::factory()->create([
            'slug' => 'teste3',
            'description' => 'teste3',
            'price' => 3900 / 100,
            'reference' => 'F1DBD17A1414997EE4BAFFAFF052E3C7'
        ]);
        Plan::factory()->create([
            'slug' => 'teste4',
            'description' => 'teste4',
            'reference' => '9ED6DD681D1DADE6643EEF811F7860A5',
            'price' => 1000 / 100,
        ]);
        Plan::factory()->create([
            'slug' => 'teste5',
            'description' => 'teste5',
            'reference' => 'A6C4D780FEFE78A554801FBC1D3FB5E6',
            'price' => 3000 / 100,
        ]);
        Plan::factory()->create([
            'slug' => 'teste6',
            'description' => 'teste6',
            'reference' => '5D64FB44F8F8D32994925F9008E8CC04',
            'price' => 3000 / 100,
        ]);
    }
}

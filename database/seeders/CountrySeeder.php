<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
        $countryName = fake()->unique()->country();
        
        \App\Models\Country::firstOrCreate([
            'name' => $countryName
        ]);
    }
    }
}

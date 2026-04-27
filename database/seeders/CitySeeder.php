<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                foreach (range(1, 10) as $index) {
        $countryName = fake()->unique()->city();
        
        \App\Models\City::firstOrCreate([
            'name' => $countryName,
            'country_id' => \App\Models\Country::inRandomOrder()->first()->id,
        ]);
    }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use App\Models\Freelancer;

class FreelancerSeeder extends Seeder
{

public function run(): void
{  
    $skills = Skill::all();
    
    $usersWithoutProfile = User::where('role', 'freelancer')
        ->doesntHave('freelancer')
        ->get();

    if($usersWithoutProfile->isEmpty())
        {
            $usersWithoutProfile =user::factory(10)->create([
                'role' =>'freelancer',
            ]);
        }

    foreach ($usersWithoutProfile as $user) {
        
        $freelancer = Freelancer::factory()->create([
            'user_id' => $user->id,
        ]);

        
        if ($skills->isNotEmpty()) {
            $freelancer->skills()->attach(
                $skills->random(rand(1, min(5, $skills->count())))->pluck('id')->toArray(),
                ['years_of_experience' => rand(1, 10)]
            );
        }
    }
}


}

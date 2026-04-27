<?php

namespace Database\Seeders;
use Database\Factories\PostFactory;
use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\Skill;
// use App\Models\Country;

use App\Models\Freelancer_Skill;
use App\Models\Post;
use App\Models\Offer;
use App\Models\Tag;
use App\Models\Post_Tag;
use App\Models\Attachment;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;



    public function run(): void
    {

     
        $this->call([
        CountrySeeder::class,
        CitySeeder::class,
        UserSeeder::class,
        TagSeeder::class,
        SkillSeeder::class,
        FreelancerSeeder::class,
        PostSeeder::class,       
        OfferSeeder::class,  
        AttachmentSeeder::class,    
        ReviewSeeder::class
        ]);


    }
}

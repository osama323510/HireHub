<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Attachment;
use App\Models\Freelancer;
class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    $freelancers = Freelancer::all();
        if ($freelancers->isNotEmpty()) {
            foreach ($freelancers->random(min(5, $freelancers->count())) as $freelancer) {
                Attachment::factory()->create([
                    'attachable_id'   => $freelancer->id,
                    'attachable_type' => Freelancer::class,
                    'freelancer_id'   => $freelancer->id, 
                ]);
            }
        }

    $offers = Offer::all();
        if ($offers->isNotEmpty()) {
            foreach ($offers->random(min(5, $offers->count())) as $offer) {
                Attachment::factory()->count(2)->create([
                    'attachable_id'   => $offer->id,
                    'attachable_type' => Offer::class,
                    'freelancer_id'   => $offer->freelancer->id
                ]);
            }
        }

    }
}

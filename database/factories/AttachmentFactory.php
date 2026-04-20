<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Freelancer;
use App\Models\Post;
/**
 * @extends Factory<Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array

{
    
    return [
        'freelancer_id'   => \App\Models\Freelancer::factory(),
        'file'            => 'attachments/' . fake()->uuid() . '.' . fake()->fileExtension(),
        'attachable_id'   => " ",
        'attachable_type' => " ",
    ];
}
}

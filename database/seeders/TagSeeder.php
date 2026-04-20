<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
    $tags = ['Web Development', 'Mobile Apps', 'UI/UX Design', 'Laravel', 'Flutter'];

    foreach ($tags as $name) {
        Tag::firstOrCreate(['name' => $name]);;
    }
    }
}

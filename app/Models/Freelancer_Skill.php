<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Freelancer_skill extends Model
{
    use HasFactory;
    protected $table = 'Freelancers_Skills';
    protected $fillable = [
        'freelancer_id',
        'skill_id',
        'years_of_experience'
    ];

    protected function casts(): array
    {
        return [
            'freelancer_id' => 'integer',
            'skill_id' => 'integer',
            'years_of_experience' => 'integer',
        ];
    }
}

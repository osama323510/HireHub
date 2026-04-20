<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Skill extends Model
{
    use HasFactory;
    protected $table = 'Skills';
    protected $fillable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            'name'=>'string',
        ];
    }

    public function freelanser()
    {
        return $this->belongsToMany(freelanser::class)->withPivot('years_of_experience');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tag extends Model
{
    use HasFactory;
    protected $table = 'Tags';
    protected $fillable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            'name'=>'string',
        ];
    }

    public function posts()
    {
        return $this->belongsToMany(post::class);
    }
}

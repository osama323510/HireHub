<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Tag extends Model
{
    use HasFactory;
    protected $table = 'Post_Tag';
    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    protected function casts(): array
    {
        return [
            'post_id' => 'integer',
            'tag_id' => 'integer',
        ];
    }

    public function post()
    {
        return $this->belongsTo(post::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}

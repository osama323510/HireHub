<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Review extends Model
{
    use HasFactory;
    protected $table = 'Reviews';
    
    protected $fillable = [
        'user_id',        
        'reviewable_id',   
        'reviewable_type', 
        'rating',
        'comment',
    ];

    protected function casts(): array
    {
        return [
            'user_id'         => 'integer',
            'reviewable_id'   => 'integer',
            'reviewable_type' => 'string',
            'rating'          => 'decimal:3,1',
            'comment'         => 'string',
        ];
    }


    public function user(): BelongsTo
    {
        
        return $this->belongsTo(User::class, 'user_id');
    }


    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }




}

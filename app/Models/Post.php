<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Carbon\Carbon;
class Post extends Model
{
    use HasFactory;
    protected $table = 'Posts'
    ;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'budget',
        'price',
        'status',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
        'title'=>'string',
        'description'=>'string',
        'user_id'=>'integer',
        'budget'=>'string',
        'price'=>'decimal:3,1',
        'status'=>'string',
        'deadline'=>'datetime',
        ];
    }

    protected $appends = ['deadline','price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
{
    
    return $this->morphMany(Review::class, 'reviewable');
}




    protected function deadline(): Attribute
    {
        return Attribute::make(
        get: function (mixed $value, array $attributes)
        {
            $now = Carbon::now();
            $deadline = Carbon::parse($attributes['deadline']);

            if ($deadline->isPast()) {
                return "Expired";
            }

            return "Active for: " . $deadline->diffForHumans($now,true);
        }

        );
    }


    protected function  price(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['budget'] == 'fixed' 
                ? "USD  " . number_format($attributes['price'], 2) 
                : "hr/  " . number_format($attributes['price'], 2)."$"
        );
    }

    public function rating(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $average = $attributes['reviews_avg_rating'] ?? null;
                if (!$average) {
                    return "No reviews yet";
                }
                return "⭐ " . number_format($average, 1);
            }
        );
    }

    public function ScopeNewpost($query)
    {
        return $query->where('status', 'open');
    }


    public function Scopebudgetlimit($query,$value)
    {
        return $query->where('price', '>=', $value);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
    }

}

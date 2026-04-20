<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Freelancer extends Model
{
    use HasFactory;
    
    protected $table = 'Freelancers';
    
    protected $fillable = [
        'user_id',
        'phone',
        'hour_price',
        'bio',
        'status',
        'is_active',
        'is_verified',
        'portfolio',
    ];

    protected function casts(): array
    {
        return [
            'portfolio' => 'json',
            'is_verified'=>'boolean',
            'is_active'=>'boolean',
            'user_id'=>'integer',
            'phone'=>'string',
            'hour_price'=>'decimal:2',
            'bio'=>'string',
            'status'=>'string',
        ];
    }

    public function offers()
    {
        return $this->hasMany(offer::class);
    }


    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class)->withPivot('years_of_experience');;
    }

    public function  Attachments ()
    {
        return $this->hasMany(Attachment::class);
    }

    


    protected function skillsSummary(): Attribute
    {
        return Attribute::make(
            get: function () {
                
                if ($this->skills->isEmpty()) {
                    return "no experience";
                }

                return $this->skills->map(function ($skill) {
                    return [
                        'name' => $skill->name,
                        'years' => $skill->pivot->years_of_experience,
                    ];
                })->toArray();
            }
        );
    }



    protected function rate(): Attribute
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


    protected function phone(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                
                $cleaned = preg_replace('/[^0-9]/', '', $value);

                if (str_starts_with($cleaned, '00')) {
                    $cleaned = substr($cleaned, 2);
                }

                if (str_starts_with($cleaned, '0') && !str_starts_with($cleaned, '00')) {
                    $cleaned = '963'.substr($cleaned, 1);
                }

                return $cleaned;
            }
        );
    }

    protected function hour_price(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value,array $attributes) {
                return number_format($attributes['hour_price'], 2);
            }
        );
    }

    public function scopeVerifiedAndActive($query)
    {
        return $query->where('is_verified', true)->where('is_active',true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeOrderByRating($query)
    {
        return $query->orderBy('reviews_avg_rating', 'desc');
    }



}

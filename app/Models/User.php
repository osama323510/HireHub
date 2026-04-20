<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'city_id',
        'role',
        'address',
        'image'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'city_id'=>'integer',
            'role'=>'string',
            'address'=>'string',
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }
    
    public function country()
    {
        return $this->city->country();
    }

    public function post()
        {
            return $this->hasMany(post::class);
        }

    public function full_name()
    {
        return $this->name.$this->lastname;
    }
    
    protected function joinedDate():Attribute
    {
        return Attribute::make(
        get: function (mixed $value, array $attributes) {
            $date = Carbon::parse($attributes['created_at']);
            
            return "Member since " . $date->format('F Y');
        }
    );
    }
    
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                
                $image = $attributes['image'] ?? null;

                if ($image) {
                    return asset('storage/' . $image);
                }
                return asset('images/default_user.jpg');
            }
        );
    }


}

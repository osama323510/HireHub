<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Offer extends Model
{
    use HasFactory;
    protected $table = 'Offers';
    protected $fillable = [
        'freelancer_id',
        'post_id',
        'offer_price',
        'description',
        'days',
        'status'

    ];

    protected function casts(): array
    {
        return [
            'freelancer_id' => 'integer',
            'post_id' => 'integer',
            'offer_price' => 'decimal:2',
            'description' => 'string',
            'days' => 'integer',
            'status' => 'string',
        ];
    }

    public function freelancer()
    {
        return $this->belongsTo(freelancer::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function Attachments()
        {
            
            return $this->morphMany(Attachment::class, 'attachable');
        }

}

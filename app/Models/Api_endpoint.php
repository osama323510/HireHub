<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Api_endpoint extends Model
{
    use HasFactory;
    
    protected $table = 'api_endpoints';
    protected $fillable = [
        'user_id',
        'endpoint',
        'method',
        'duration',
        'type'

    ];

    protected function casts(): array
    {
        return [
            
            'endpoint' => 'string',
            'method'=>'string',
            'duration'=>'integer',
            'type'=>'string'
            
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

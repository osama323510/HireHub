<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Attachment extends Model
{
    use HasFactory;
    protected $table = 'Attachments';
    
protected $fillable = [
        'freelancer_id',
        'file',
        'attachable_id',
        'attachable_type',
    ];

    protected function casts(): array
    {
        return [
            'file'         => 'string',
            'attachable_id'   => 'integer',
            'attachable_type' => 'string',
        ];
    }


    public function attachable()
    {
        return $this->morphTo();
    }

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }



}


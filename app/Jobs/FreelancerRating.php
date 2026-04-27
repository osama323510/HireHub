<?php

namespace App\Jobs;

use App\Models\Freelancer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class FreelancerRating implements ShouldQueue
{
    use Queueable;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(): void
    {
        $lock = Cache::lock('update_rating_' . $this->id, 10);
        if ($lock->get()) {
            try {
                $freelancer = Freelancer::find($this->id);
                if ($freelancer) {
                    $average = $freelancer->reviews()->avg('rating') ?: 0;
                    $freelancer->update([
                        'rating' => round($average, 2)
                    ]);
                    Cache::forget('freelancer:available');
                }
            } finally {
                $lock->release();
            }
        } else {
            $this->release(5);
        }
    }
}
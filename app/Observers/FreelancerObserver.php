<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Freelancer;

class FreelancerObserver
{
    /**
     * Handle the Freelancer "created" event.
     */
    public function created(Freelancer $freelancer): void
    {
        Cache::forget('freelancer:available');
    }

    /**
     * Handle the Freelancer "updated" event.
     */


    public function updated(Freelancer $freelancer): void
    {
        Cache::forget('freelancer:available');
    }

    /**
     * Handle the Freelancer "deleted" event.
     */
    public function deleted(Freelancer $freelancer): void
    {
        //
    }

    /**
     * Handle the Freelancer "restored" event.
     */
    public function restored(Freelancer $freelancer): void
    {
        //
    }

    /**
     * Handle the Freelancer "force deleted" event.
     */
    public function forceDeleted(Freelancer $freelancer): void
    {
        //
    }
}

<?php

namespace App\Jobs;

use App\Models\Offer;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OfferAccept implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $id;
    public $post_id;
    public function __construct($post_id,$id)
    {
        $this->id=$id;
        $this->post_id=$post_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Offer::where('post_id', $this->post_id)
            ->where('id', '!=', $this->id)
            ->update(['status' => 'rejected']);


    }
}

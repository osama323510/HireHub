<?php

namespace App\Services\Post;

use App\Interfaces\NotificationServiceInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Jobs\MailHandl;

class CreatePostService
{
    /**
     * Create a new class instance.
     */
    protected $notification;

    public function __construct(NotificationServiceInterface $notification)
    {
        $this->notification = $notification;
    }

    public function create($data)
    {
        $post = Post::create([
            'user_id'     => Auth::id(),
            'title'       => $data['title'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'budget'      => $data['budget'],
            'deadline'    => $data['deadline'],
        ]);

        $post->tags()->sync($data['tags']);
        $this->notification->send($post->user->email,"you created new post");
        return $post->load('tags'); 
    }
}
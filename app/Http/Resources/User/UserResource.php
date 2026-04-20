<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this['user']; 

        return [
            'id'         => $user->id,
            'name'       => $user->full_name(), // تأكد أن الدالة موجودة في موديل User
            'image'      => $user->avatarUrl,   // تأكد أن هذا الـ Accessor موجود
            'joined'     => $user->joinedDate,
            'token'      => $this['token'],
            'token_type' => $this['token_type'],
            'state'=>'succesful'
        ];
    }
}

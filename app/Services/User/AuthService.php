<?php
namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct()
    {
        
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }
        

        $token = $user->createToken('auth_token')->plainTextToken;
        
        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
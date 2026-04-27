<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\User\AuthService;
use App\Http\Requests\User\AuthRequest;
use App\Http\Resources\User\UserResource;

class AuthController extends Controller
{
    
    public function login(AuthRequest $request ,AuthService  $service)
    {
        $result = $service->login($request->validated());
        if (!$result) {
            return response()->json(['message' => 'faild to login'], 401);
        }  
        return new UserResource($result);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request, UserService $userService)
    {
        $user = $userService->Create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return (new UserResource($user))->additional(['token' => $token]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if($request->authenticate()){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return (new UserResource($user))->additional(['token' => $token]);
        }

        return response()->json([
            'message' => 'Your credentials does not match.'
        ], 401);
    }
}

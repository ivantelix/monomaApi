<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->deniedAccess();
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => []
            ],
            'data' => [
                'token' => $token,
                'minutes_to_expire' => 1440
            ]
        ], 200);
    }


    private function deniedAccess(): JsonResponse
    {
        return response()->json([
            "meta" => [
                "success" => [
                    "success" => false,
                    "errors" => [
                        "Password incorrect for: tester"
                    ]
                ]
            ]
        ], 401);
    }
}

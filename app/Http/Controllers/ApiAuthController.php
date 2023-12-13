<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use Throwable;
use Tymon\JWTAuth\JWTGuard;

/**
 * @OA\Info(
 *     title="My First API",
 *     version="0.1"
 * )
 */
class ApiAuthController extends Controller
{
    protected JWTGuard $auth;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->auth = auth('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @OA\Post(
     *     path="/api/login",
     *     @OA\RequestBody(
     *         response="200",
     *         description="The data"
     *     )
     *     @OA\Response(
     *         response="200",
     *         description="The data"
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        // Generate a token for the user if the credentials are valid
        if (!$token = $this->auth->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->auth->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $this->auth->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 401);
        }

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->auth->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in_minutes' => $this->auth->factory()->getTTL(),
        ]);
    }
}

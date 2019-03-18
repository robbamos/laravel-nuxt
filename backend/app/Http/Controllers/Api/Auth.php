<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * Auth User Model.
 *
 * @category Controller
 * @package  Vertical
 * @author   Rob Amos <r.amos21@outlook.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/robbamos/laravel-nuxt
 */
class Auth extends Controller
{
    /**
     * API auth login
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return $this->respondNotAuthorised();
        }
        return $this->respondWithToken($token);
    }

    /**
     * API Authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->respondSuccess(
            [
                'user' => auth()->user(),
                'role' => auth()->user()->role->name,
            ]
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->respondSuccess(['message' => 'Successfully logged out']);
    }

    /**
     * API Auth Register
     *
     * @return void
     */
    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:200',
                'password' => 'required|min:6|max:25',
                'email' => 'required|unique:users',
            ]
        );
        // return $validated;
        $newUser = User::create($validated);
        $newUser->assignRole('user');
        $token = $newUser->createToken('apiToken')->accessToken;
        return $this->respondSuccess(
            [
                'user' => $newUser,
                'token' => $token,
                'role' => $newUser->role->name,
            ]
        );

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
        return $this->respondSuccess(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        );
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Auth User Model.
 *
 * @category Controller
 * @package  laravel-nuxt
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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]
        );
        // return $validated;

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);


        return $this->respondSuccess($newUser);
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
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        );
    }
}

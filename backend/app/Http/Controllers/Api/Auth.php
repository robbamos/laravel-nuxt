<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthHandler;

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
     * @return User user with api token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (AuthHandler::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('apiToken')->accessToken;
            return $this->respondSuccess(['user' => $user, 'token' => $token, 'role' => $user->role->name]);
        }

        return $this->respondNotAuthorised();

    }

    /**
     * API Authenticated user
     *
     * @return void
     */
    public function me()
    {
        $user = auth()->user();

        if ($user != null) {
            return $this->respondSuccess(['user' => $user, 'role' => $user->role->name]);
        }

        return $this->respondNotAuthorised();
    }

    /**
     * API Auth logout
     *
     * @return void
     */
    public function logout()
    {
        try {
            $user = auth()->user();
            foreach ($user->tokens as $token) {
                $token->revoke();
            }
            return $this->respondSuccess();

        } catch (Exception $e) {
            return $this->respondNotAuthorised();
        }
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

}

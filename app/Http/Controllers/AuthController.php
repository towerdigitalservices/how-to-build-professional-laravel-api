<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Requests\Authentication\UpdatePasswordRequest;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    /**
     * @property UserRepository
     */
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();

        $user = $this->users->create($request->validated());

        return $user;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return $this->respondWithError('Invalid Credentials provided', 401);
        }
        return $this->respondWithToken($token);
    }

    public function getAuthUser()
    {
        if ($user = auth()->user()) {
            return $user;
        }
        return $this->respondWithError('Unauthenticated', 401);
    }

    public function refresh()
    {
        if (!auth()->user()) {
            return $this->respondWithError('Unauthenticated', 401);
        }

        $token = auth()->refresh();

        return $this->respondWithToken($token);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if($this->users->updatePassword($request->user_id, $request->password)) {
            return $this->respondWithMessage('Your password was successfully updated.');
        }
        return $this->respondWithError('Unable to update your password', 422);
    }

    public function logout()
    {
        auth()->logout();

        return $this->respondWithMessage('You were successfully logged out.');
    }
}

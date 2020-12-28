<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    protected function respondWithError($message, $status)
    {
        return response([
            'message' => $message,
            'status' => $status,
        ], $status);
    }

    protected function respondWithMessage($message)
    {
        return response([
            'message' => $message,
        ]);
    }

    protected function respondwithCollection(Collection $collection)
    {

    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginPostRequest $request): JsonResponse|ResponseFactory
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $userLogged = $request->user();
            $token = $userLogged->createToken($request->device_name)->plainTextToken;
            $data = [
                'token' => $token,
                'user' => $userLogged->only(['id', 'name', 'email']),
            ];
            return responder()->success($data)->respond();
        }
        return responder()->error('Invalid credentials')->respond(401);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(LoginPostRequest $request): JsonResponse|ResponseFactory
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return responder()->error('Invalid credentials')->respond(401);
        }

        $userLogged = $request->user();
        $token = $userLogged->createToken($request->device_name)->plainTextToken;
        return responder()->success($userLogged, UserTransformer::class)
            ->meta(['token' => $token])
            ->respond(Response::HTTP_OK);
    }
}

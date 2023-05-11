<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use \Illuminate\Hashing\HashManager;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class SignUp extends Controller
{
    public function __invoke(SignUpRequest $request, HashManager $hash): JsonResponse|ResponseFactory
    {
        $fields = $request->validated();
        $fields['password'] = $hash->make($fields['password']);
        $user = User::create($fields);

        $user->assignRole($request['role']);

        return responder()->success($user)->respond(201);
    }
}

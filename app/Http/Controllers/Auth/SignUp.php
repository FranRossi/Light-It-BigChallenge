<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SignUp extends Controller
{
    public function __invoke(SignUpRequest $request, Hasher $hash): JsonResponse|ResponseFactory
    {
        $fields = $request->validated();
        $fields['password'] = $hash->make($fields['password']);
        $user = User::create($fields);

        $user->assignRole($request['role']);

        return responder()->success($user)->respond(Response::HTTP_CREATED);
    }
}

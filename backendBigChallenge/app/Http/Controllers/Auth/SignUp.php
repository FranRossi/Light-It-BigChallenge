<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class SignUp extends Controller
{
    public function __invoke(SignUpRequest $request): JsonResponse|ResponseFactory
    {
        $fields = $request->validated();
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);

         $user->assignRole($request['role']);

         return responder()->success($user)->respond(201);
    }
}

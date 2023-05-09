<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SignUp extends Controller
{
    public function __invoke(SignUpRequest $request):Response|ResponseFactory
    {
        $fields = $request->validated();
        $fields['password'] = Hash::make($fields['password']);
        $user = User::create($fields);

         $user->assignRole($request['role']);

         return response($user, Response::HTTP_CREATED);
    }
}

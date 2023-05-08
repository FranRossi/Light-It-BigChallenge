<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SignUp extends Controller
{
    public function __invoke(SignUpRequest $request):Response|ResponseFactory
    {

        $user = User::create($request->validated());

        $user->assignRole($request['role']);

        return response('User registered successfully', Response::HTTP_OK);
    }
}

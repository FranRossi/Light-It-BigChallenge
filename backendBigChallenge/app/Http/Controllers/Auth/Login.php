<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginPostRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($request->device_name)->plainTextToken;
        $data = [
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email']),
        ];
        return responder()->success($data)->respond(200);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Illuminate\Http\Request;

class Logout extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): SuccessResponseBuilder
    {
        $request->user()->currentAccessToken()->delete();
        return responder()->success(['message' => 'Logout successfully']);
    }
}

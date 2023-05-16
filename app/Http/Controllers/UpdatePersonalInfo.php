<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonalInfoRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdatePersonalInfo extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePersonalInfoRequest $request): JsonResponse|ResponseFactory
    {
        $user = $request->user();
        $user->update($request->validated());
        return responder()->success($user)->respond(Response::HTTP_OK);
    }
}

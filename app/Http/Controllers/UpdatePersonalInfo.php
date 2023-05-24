<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class UpdatePersonalInfo extends Controller
{
    public function __invoke(UpdatePersonalInfoRequest $request): JsonResponse|ResponseFactory
    {
        $user = $request->user();

        $user->update($request->validated());

        return responder()->success($user, UserTransformer::class)->respond();
    }
}

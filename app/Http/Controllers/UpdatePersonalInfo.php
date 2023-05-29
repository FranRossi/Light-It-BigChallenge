<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

class UpdatePersonalInfo extends Controller
{
    public function __invoke(UpdatePersonalInfoRequest $request): JsonResponse
    {
        $user = $request->user();

        $user->update($request->validated());

        return responder()->success($user, UserTransformer::class)->respond();
    }
}

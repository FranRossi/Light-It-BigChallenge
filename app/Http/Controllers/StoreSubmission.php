<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class StoreSubmission extends Controller
{
    public function __invoke(StoreSubmissionRequest $request): JsonResponse|ResponseFactory
    {
        $submission = $request->user();

        $submission->create($request->validated());

        return responder()->success($submission)->respond();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\SubmissionStatus;
use App\Http\Requests\StoreSubmissionRequest;
use App\Transformers\SubmissionTransformer;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StoreSubmission extends Controller
{
    public function __invoke(StoreSubmissionRequest $request): JsonResponse|ResponseFactory
    {
        $user = $request->user();
        $data = $request->validated();
        $data['status'] = SubmissionStatus::PENDING->value;
        $submission = $user->submissionsPatient()->create($data);
        return responder()->success($submission, SubmissionTransformer::class)->respond(Response::HTTP_CREATED);
    }
}

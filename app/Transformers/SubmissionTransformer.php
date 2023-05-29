<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Submission;
use Flugg\Responder\Transformers\Transformer;

class SubmissionTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    public function transform(Submission $submission): array
    {
        return [
            'id' => $submission->id,
            'title' => $submission->title,
            'symptoms' => $submission->symptoms,
            'status' => $submission->status,
        ];
    }
}

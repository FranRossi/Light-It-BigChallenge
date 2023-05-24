<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
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

    /**
     * Transform the model.
     *
     */
    public function transform(User $user): array
    {
        return [
            'id' =>  $user->id,
            'name' =>  $user->name,
            'email' =>  $user->email,
            'role' =>  $user->roles->first()?->name,
            'phone_number' => $user?->phone,
            'weight' => $user?->weight,
            'height' => $user?->height,
            'other_info' =>$user?->other_info,
        ];
    }
}

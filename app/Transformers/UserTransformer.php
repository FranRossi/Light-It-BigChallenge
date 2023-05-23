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
     *
     * @return array
     */
    public function transform(User $user)
    {
        $role = $this->getUserRole($user);
        return [
            'id' => (int) $user->id,
            'name' => (string) $user->name,
            'email' => (string) $user->email,
            'role' => (string) $role,
            'phone_number' => (string) ($user->phone) ?? null,
            'weight' => ((string) $user->weight) ?? null,
            'height' => (string) $user->height ?? null,
            'other_info' => (string) $user->other_info ?? null,
        ];
    }

    protected function getUserRole(User $user): ?string
    {
        $role = $user->roles->first();
        return $role?->name;
    }
}

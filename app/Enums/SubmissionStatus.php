<?php

declare(strict_types=1);

namespace App\Enums;

enum SubmissionStatus: string
{
    case PENDING = 'PENDING';
    case PROGRESS = 'PROGRESS';
    case DONE = 'DONE';

    public static function toArray(): array
    {
        return [
            self::PENDING->value,
            self::PROGRESS->value,
            self::DONE->value,
        ];
    }
}

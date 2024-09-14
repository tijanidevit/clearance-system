<?php

namespace App\Enums;

enum StudentStatusEnum : string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, static::cases());
    }
}

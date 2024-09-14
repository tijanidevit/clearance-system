<?php

namespace App\Enums;

enum ClearanceStatusEnum : string
{
    case APPROVED = 'approved';
    case DECLINED = 'declined';

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, static::cases());
    }
}

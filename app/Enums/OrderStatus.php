<?php

namespace App\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case COMPLETE = 'complete';

    public function getColor(): string
    {
        return match ($this) {
            self::NEW => 'primary',
            self::CONFIRMED => 'info',
            self::CANCELLED => 'error',
            self::COMPLETE => 'success',
        };
    }

    public function toString(): string
    {
        return match ($this) {
            self::NEW => 'Новый',
            self::CONFIRMED => 'Подтвержден',
            self::CANCELLED => 'Отемен',
            self::COMPLETE => 'Выполнен',
        };
    }
}

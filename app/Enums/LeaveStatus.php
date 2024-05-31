<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum LeaveStatus: int implements HasLabel, HasColor
{
    case NOT_APPROVED = 0;
    case APPROVED = 1;
    

    public function getLabel(): string
    {
        return match ($this) {
            self::NOT_APPROVED => 'Not Approved',
            self::APPROVED => 'Approved',
           
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NOT_APPROVED => 'warning',
            self::APPROVED => 'success',
          
        };
    }
}
<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CustomerType: string implements HasColor, HasIcon, HasLabel
{
    case New = 'new';

    case Regular = 'regular';

    case Unknown = 'unknown';

    case Family = 'family';

    case Friend = 'friend';

    public function getLabel(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Regular => 'Regular',
            self::Unknown => 'Unknown',
            self::Family => 'Family',
            self::Friend => 'Friend',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::New => 'info',
            self::Regular => 'warning',
            self::Unknown =>'dark', 
            self::Family => 'success',
            self::Friend => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-m-sparkles',
            self::Regular => 'heroicon-m-arrow-path',
            self::Unknown => 'heroicon-m-truck',
            self::Family => 'heroicon-m-check-badge',
            self::Friend => 'heroicon-m-check-badge',
        };
    }
}
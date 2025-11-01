<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ShippingMethod: string implements HasLabel
{
    case Pathao = 'pathao';
    case RedX = 'redx';
    case SteedFast = 'steedfast';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pathao => 'Pathao',
            self::RedX => 'RedX',
            self::SteedFast => 'SteedFast',
        };
    }

}

<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VaccinationStatus: string implements HasLabel
{
    case NOT_VACCINATED = 'Not Vaccinated';
    case SCHEDULED = 'Scheduled';
    case VACCINATED = 'Vaccinated';

    public function getLabel(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'Not Vaccinated',
            self::SCHEDULED => 'Scheduled',
            self::VACCINATED => 'Vaccinated',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'danger',
            self::SCHEDULED => 'warning',
            self::VACCINATED => 'success',
        };
    }

}

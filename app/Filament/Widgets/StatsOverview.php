<?php

namespace App\Filament\Widgets;

use App\Enums\VaccinationStatus;
use App\Models\Vaccination;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Registered User', Vaccination::query()->count())
                ->icon('heroicon-m-user-group'),
            Stat::make('Vaccinated User', Vaccination::query()
                ->where('status', VaccinationStatus::VACCINATED)->count())
                ->icon('heroicon-m-user-group'),
            Stat::make('Not Vaccinated User', Vaccination::query()
                ->where('status', VaccinationStatus::NOT_VACCINATED)->count())
                ->icon('heroicon-m-user-group'),
            Stat::make('Scheduled User', Vaccination::query()
                ->where('status', VaccinationStatus::SCHEDULED)->count())
                ->icon('heroicon-m-user-group'),
        ];
    }
}

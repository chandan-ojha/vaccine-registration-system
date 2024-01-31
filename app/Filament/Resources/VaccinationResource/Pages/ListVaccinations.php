<?php

namespace App\Filament\Resources\VaccinationResource\Pages;

use App\Enums\VaccinationStatus;
use App\Filament\Resources\VaccinationResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListVaccinations extends ListRecords
{
    protected static string $resource = VaccinationResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Vaccinations'),
            'Vaccinated' => Tab::make('Vaccinated')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', VaccinationStatus::VACCINATED);
                }),
            'scheduled' => Tab::make('Scheduled')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', VaccinationStatus::SCHEDULED);
                }),
            'Not Vaccinated' => Tab::make('Not Vaccinated')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', VaccinationStatus::NOT_VACCINATED);
                }),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Enums\VaccinationStatus;
use App\Filament\Resources\VaccinationResource\Pages;
use App\Filament\Resources\VaccinationResource\RelationManagers;
use App\Models\Vaccination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VaccinationResource extends Resource
{
    protected static ?string $model = Vaccination::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye-dropper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nid')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(11),
                Forms\Components\Select::make('center_id')
                    ->relationship('center', 'name')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->default(VaccinationStatus::NOT_VACCINATED)
                    ->options(VaccinationStatus::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label('Filters');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('center.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                Tables\Columns\TextColumn::make('notification_sent_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(VaccinationStatus::class)
                    ->default(VaccinationStatus::NOT_VACCINATED)
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('center')
                    ->relationship('center', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('has_status')
                    ->label('Show Only Vaccinated Patients')
                    ->toggle()
                    ->query(function ($query) {
                        $query->where('status', VaccinationStatus::VACCINATED);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('scheduled')
                        ->visible(function ($record) {
                            return $record->status === (VaccinationStatus::NOT_VACCINATED);
                        })
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->action(function (Vaccination $record) {
                            $record->scheduled();
                        })->after(function () {
                            Notification::make()->warning()->title('This vaccination was scheduled')
                                ->duration(1000)
                                ->body('The doctor has been notified and the patient has been added to the vaccination schedule.')
                                ->send();
                        }),
                    Tables\Actions\Action::make('vaccinated')
                        ->visible(function ($record) {
                            return $record->status === (VaccinationStatus::NOT_VACCINATED) || $record->status === (VaccinationStatus::SCHEDULED);
                        })
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Vaccination $record) {
                            $record->vaccinated();
                        })->after(function () {
                            Notification::make()->success()->title('This vaccination was done')
                                ->duration(1000)
                                ->body('The patient has been vaccinated.')
                                ->send();
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->tooltip('This will export all records visible in the table. Adjust filters to export a subset of records.')
                    ->action(function ($livewire) {
                        dd('Exporting...', $livewire);
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVaccinations::route('/'),
            'create' => Pages\CreateVaccination::route('/create'),
            //'edit' => Pages\EditVaccination::route('/{record}/edit'),
        ];
    }
}

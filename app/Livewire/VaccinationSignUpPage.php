<?php

namespace App\Livewire;

use App\Models\Vaccination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VaccinationSignUpPage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Full Name'),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(),
                Forms\Components\TextInput::make('nid')
                    ->numeric()
                    ->required()
                    ->unique()
                    ->rules(['digits:10'])
                    ->label('NID')
                    ->validationAttribute('nid'),
                Forms\Components\TextInput::make('phone')
                    ->prefix('+88')
                    ->numeric()
                    ->required()
                    ->tel()
                    ->startsWith('01')
                    ->unique()
                    ->rules(['digits:11'])
                    ->label('Phone Number'),
                Forms\Components\Select::make('center_id')
                    ->relationship('center', 'name')
                    ->native(false)
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Vaccine center'),
            ])
            ->statePath('data')
            ->model(Vaccination::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = Vaccination::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->success()
            ->title('Success!')
            ->body('We will notify you the availability of vaccine.')
            ->seconds(5)
            ->send();

        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.vaccination-sign-up-page');
    }
}

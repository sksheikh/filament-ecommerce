<?php

namespace App\Filament\Pages\Settings;

use App\Models\Setting;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class GeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.settings.general-settings';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('General Information')
                    ->components([
                        TextInput::make('site_name')
                            ->label('Shop Name')
                            ->required(),
                        TextInput::make('site_email')
                            ->label('Contact Email')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Contact Phone'),
                        TextInput::make('shop_address')
                            ->label('Shop Address'),
                        TextInput::make('shop_description')
                            ->label('Shop Description'),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Localization & Footer')
                    ->components([
                        \Filament\Forms\Components\Select::make('currency')
                            ->options([
                                'BDT' => 'Bangladeshi Taka (৳)',
                                'USD' => 'US Dollar ($)',
                                'EUR' => 'Euro (€)',
                            ])
                            ->default('BDT'),
                        TextInput::make('footer_text')
                            ->label('Footer Text'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            Notification::make()
                ->title('Settings updated successfully')
                ->success()
                ->send();
        } catch (\Exception $exception) {
            Notification::make()
                ->title('Error updating settings')
                ->danger()
                ->body($exception->getMessage())
                ->send();
        }
    }
}

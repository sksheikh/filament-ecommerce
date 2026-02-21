<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use App\Filament\Resources\Customers\Pages\CreateCustomer;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire): bool => $livewire instanceof CreateCustomer),

                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),

                Toggle::make('is_active')
                    ->default(true),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->default(now()),
            ]);
    }
}

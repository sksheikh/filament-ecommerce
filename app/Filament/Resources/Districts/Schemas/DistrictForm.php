<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('District Information')->schema([
                    \Filament\Forms\Components\Select::make('division_id')
                        ->relationship('division', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('bn_name')
                        ->label('Bengali Name')
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('lat')
                        ->label('Latitude')
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('lon')
                        ->label('Longitude')
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('url')
                        ->label('URL')
                        ->url()
                        ->maxLength(255),
                ])->columns(2),
            ]);
    }
}

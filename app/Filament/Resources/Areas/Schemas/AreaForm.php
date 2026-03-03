<?php

namespace App\Filament\Resources\Areas\Schemas;

use Filament\Schemas\Schema;

class AreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Area Information')->schema([
                    \Filament\Forms\Components\Select::make('district_id')
                        ->relationship('district', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('bn_name')
                        ->label('Bengali Name')
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('url')
                        ->label('URL')
                        ->url()
                        ->maxLength(255),
                ])->columns(2),
            ]);
    }
}

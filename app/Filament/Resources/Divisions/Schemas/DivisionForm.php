<?php

namespace App\Filament\Resources\Divisions\Schemas;

use Filament\Schemas\Schema;

class DivisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Division Information')->schema([
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

<?php

namespace App\Filament\Resources\DeliveryCharges\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DeliveryChargeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Delivery Charge Information')->schema([
                    \Filament\Forms\Components\TextInput::make('name')
                        ->required()
                        ->placeholder('e.g. Inside Dhaka')
                        ->maxLength(255),
                    \Filament\Forms\Components\TextInput::make('amount')
                        ->required()
                        ->numeric()
                        ->default(0.0)
                        ->prefix('৳'),
                    \Filament\Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->required(),
                ])->columns(3),
                \Filament\Schemas\Components\Section::make('Location Mapping')->schema([
                    \Filament\Forms\Components\Select::make('districts')
                        ->relationship('districts', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->live(),
                    \Filament\Forms\Components\Select::make('areas')
                        ->relationship(
                            'areas', 
                            'name', 
                            modifyQueryUsing: fn (\Illuminate\Database\Eloquent\Builder $query, \Filament\Schemas\Components\Utilities\Get $get) => $query->whereIn('district_id', $get('districts') ?? [])
                        )
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->disabled(fn (\Filament\Schemas\Components\Utilities\Get $get) => empty($get('districts'))),
                ])->columns(1),
            ]);
    }
}

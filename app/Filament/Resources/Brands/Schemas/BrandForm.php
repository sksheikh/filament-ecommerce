<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('Brand Name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(String $operation, $state, $set) =>
                    $operation === 'create' ? $set('slug', str()->slug($state)) : null),
                TextInput::make('slug')
                    ->placeholder('Auto generated from name')
                    ->required()
                    ->disabled()
                    ->maxLength(255)
                    ->unique(Brand::class, 'slug', ignoreRecord: true)
                    ->dehydrated(),
                FileUpload::make('image')
                    ->image()
                    ->directory('brands')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}

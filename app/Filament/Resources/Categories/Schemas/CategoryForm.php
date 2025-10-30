<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Set;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('Category Name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(String $operation, $state, Set $set) =>
                    $operation === 'create' ? $set('slug', str()->slug($state)) : null),

                TextInput::make('slug')
                    ->placeholder('Auto generated from name')
                    ->required()
                    ->disabled()
                    ->maxLength(255)
                    ->unique(Category::class, 'slug', ignoreRecord: true)
                    ->dehydrated(),

                FileUpload::make('image')
                    ->image()
                    ->directory('categories')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}

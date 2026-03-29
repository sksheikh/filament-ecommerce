<?php

namespace App\Filament\Resources\Products\Schemas;

use Faker\Core\File;
use App\Models\Product;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Components\Utilities\Set;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                   Section::make('Product Information')->schema([
                        TextInput::make('name')
                            ->placeholder('Product Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(String $operation, $state, Set $set) =>
                                $operation === 'create' ? $set('slug', str()->slug($state)) : null
                            ),

                        TextInput::make('slug')
                            ->placeholder('product-slug')
                            ->required()
                            ->disabled()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->dehydrated(),

                        Textarea::make('short_description')
                            ->placeholder('Short product description (shown on product detail page)')
                            ->rows(3)
                            ->columnSpanFull(),

                        MarkdownEditor::make('description')
                            ->placeholder('Product Description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),

                   ])->columns(2),

                   Section::make('Product Images')->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable(),


                   ]),
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('BDT')
                            ->placeholder('0.00'),

                        TextInput::make('discount_price')
                            ->numeric()
                            ->prefix('BDT')
                            ->label('Discount Price')
                            ->placeholder('Leave blank if no discount'),
                    ]),

                    Section::make('Associations')->schema([
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            // ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name'),
                    ]),

                    Section::make('Status')->schema([
                        TextInput::make('stock_quantity')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->label('Stock Quantity'),

                        Toggle::make('is_stock')
                            ->required()
                            ->default(true),

                        Toggle::make('is_active')
                            ->required()
                            ->default(true),

                        Toggle::make('is_featured')
                            ->required(),

                        Toggle::make('on_sale')
                            ->required(),
                    ])
                ])->columnSpan(1),
            ])->columns(3);
    }
}

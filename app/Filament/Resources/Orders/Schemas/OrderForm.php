<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Schemas\Schema;
use App\Enums\ShippingMethod;
use Illuminate\Support\Number;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->placeholder('Select a customer')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->relationship('user', 'name'),

                        Select::make('payment_method')
                            ->placeholder('Select a payment method')
                            ->options(PaymentMethod::class)
                            ->required(),

                        Select::make('payment_status')
                            ->placeholder('Select a payment status')
                            ->options(PaymentStatus::class)
                            ->default(PaymentStatus::Pending)
                            ->required(),

                        ToggleButtons::make('status')
                            ->inline()
                            ->options(OrderStatus::class)
                            ->default(OrderStatus::New)
                            ->required(),

                           Select::make('shipping_method')
                            ->placeholder('Select a shipping method')
                            ->options(ShippingMethod::class)
                            ->required(),

                        Textarea::make('notes')
                            ->placeholder('Additional notes about the order...')
                            ->columnSpanFull(),


                    ])->columns(2),

                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->placeholder('Select a product')
                                    ->searchable()
                                    ->required()
                                    ->preload()
                                    ->relationship('product', 'name')
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set) => $set(
                                        'unit_amount',
                                        $state ? \App\Models\Product::find($state)->price : 0
                                    ))
                                    ->afterStateUpdated(fn($state, Set $set) => $set(
                                        'total_amount',
                                        $state ? \App\Models\Product::find($state)->price : 0
                                    )),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->default(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $unitAmount = $get('unit_amount') ?? 0;
                                        $set('total_amount', $unitAmount * $state);
                                    }),

                                TextInput::make('unit_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),


                            ])->columns(12),

                            Placeholder::make('grand_total_placeholder')
                                ->label('Grand Total')
                                ->content(function(Get $get, Set $set){
                                    $total = 0;
                                    if(!$repeaters = $get('items')){
                                        return $total;
                                    }

                                    foreach($repeaters as $key => $repeater){
                                        $total += $get("items.{$key}.total_amount") ?? 0;
                                    }

                                    $set('grand_total', $total);
                                    return Number::currency($total, 'bdt');
                                }
                            ),

                            Hidden::make('grand_total')
                                ->default(0)
                    ])
                ])->columnSpanFull(),
            ]);
    }
}

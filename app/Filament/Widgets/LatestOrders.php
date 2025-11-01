<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Enums\OrderStatus;
use Filament\Tables\Table;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Orders\OrderResource;

class LatestOrders extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->sortable()
                    ->money('BDT'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
                    // ->formatStateUsing(fn ($state) => OrderStatus::from($state)->getLabel())
                    // ->color(fn ($state) => OrderStatus::from($state)->getColor())
                    // ->icon(fn ($state) => OrderStatus::from($state)->getIcon()),

                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('View')
                    ->url(fn (Order $order) => OrderResource::getUrl('view', ['record' => $order]))
                    ->icon('heroicon-o-eye'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}

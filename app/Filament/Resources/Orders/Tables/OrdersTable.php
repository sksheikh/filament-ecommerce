<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use App\Enums\OrderStatus;
use Filament\Tables\Table;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
// use Filament\Tables\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Actions\ActionGroup;


class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->money('bdt')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make('shipping_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
               ActionGroup::make([
                    // ViewAction::make(),
                    Action::make('custom_detail')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                        ->color('warning')
                        ->url(fn(Order $record): string => \App\Filament\Resources\Orders\OrderResource::getUrl('detail', ['record' => $record])),
                    EditAction::make(),

                    Action::make('invoice')
                        ->label('Invoice')
                        ->icon('heroicon-o-document-text')
                        ->url(fn(Order $record): string => \App\Filament\Resources\Orders\OrderResource::getUrl('invoice', ['record' => $record])),
                    Action::make('delivery-slip')
                        ->label('Delivery Slip')
                        ->icon('heroicon-o-truck')
                        ->url(fn(Order $record): string => \App\Filament\Resources\Orders\OrderResource::getUrl('delivery-slip', ['record' => $record])),
               ])
            ])
            ->bulkActions([
                BulkActionGroup::make([

                ]),
            ]);
    }
}

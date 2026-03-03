<?php

namespace App\Filament\Resources\Districts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class DistrictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('division.name')
                    ->label('Division')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('bn_name')
                    ->label('Bengali Name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('areas_count')
                    ->counts('areas')
                    ->label('Areas'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

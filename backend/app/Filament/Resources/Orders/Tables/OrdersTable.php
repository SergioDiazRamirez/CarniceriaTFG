<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('trad.order_number')),
                TextColumn::make('orderStatus.name')
                    ->label(__('trad.status'))
                    ->sortable(),
                TextColumn::make('address.full_address')
                    ->label(__('trad.address'))
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label(__('trad.email'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('card_id')
                    ->label(__('trad.pay'))
                    ->getStateUsing(
                        fn($record) => $record->card ? 
                            $record->card->brand . ' • ' . $record->card->last_4 
                            : __('trad.at_store'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('trad.created_at'))
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('trad.updated_at'))
                    ->dateTime('d/m/y H:i')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

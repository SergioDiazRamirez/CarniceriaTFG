<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('trad.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('trad.email'))
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->label(__('trad.email_verified'))
                    ->dateTime('d M y - h:m')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('trad.created_at'))
                    ->dateTime('d M y - h:m')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('trad.updated_at'))
                    ->dateTime('d M y - h:m')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('default_address_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('billing_address_id')
                //     ->numeric()
                //     ->sortable(),
                IconColumn::make('is_admin')
                    ->label(__('trad.admin'))
                    ->boolean(),
            ])
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

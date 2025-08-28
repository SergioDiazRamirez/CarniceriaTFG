<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\RepeatableEntry;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label(__('trad.order_number')),
                TextEntry::make('user_id')
                    ->label(__('trad.user'))
                    ->getstateUsing(fn($record) =>$record->user?->email),
                TextEntry::make('card_id')
                    ->label(__('trad.pay'))
                    ->getStateUsing(fn($record) => $record->card ? 
                        $record->card->brand . ' • ' . $record->card->last_4 
                        : __('trad.at_store')),
                TextEntry::make('status_id')
                    ->label(__('trad.status'))
                    ->getStateUsing(fn ($record) => $record->orderStatus?->name),
                TextEntry::make('created_at')
                    ->label(__('trad.created_at'))
                    ->dateTime('d M y - H:i'),
                TextEntry::make('updated_at')
                    ->label(__('trad.updated_at'))
                    ->dateTime('d M y - H:m'),
                                    TextEntry::make('address_id')
                    ->label(__('trad.address'))
                    ->getStateUsing(fn ($record) => $record->address?->full_address),
                                    TextEntry::make('total_price')
                    ->label(__('trad.total_price'))
                    ->state(fn ($record) => $record->orderItems->sum('total_price'))
                    ->suffix(' €'),
                RepeatableEntry::make('orderItems')
                    ->label(__('trad.products'))
                    ->schema([
                        TextEntry::make('product.name')->label(__('trad.article')),
                        TextEntry::make('quantity')->label(__('trad.quantity'))
                            ->hidden(fn ($state) => $state === null),
                        TextEntry::make('weight')
                            ->label(__('trad.weight'))
                            ->suffix(' kg')
                            ->formatStateUsing(fn ($state) => $state !== null 
                                ? rtrim(rtrim(number_format($state, 3, ',', ''), '0'), ',')
                                : '')
                            ->hidden(fn ($state) => $state === null),                            
                        TextEntry::make('total_price')->label(__('trad.price'))->money('EUR'),
                    ])
                    ->columns(4),
            ]);
    }
}

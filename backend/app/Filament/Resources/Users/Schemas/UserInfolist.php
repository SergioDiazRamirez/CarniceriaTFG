<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('trad.name')),
                TextEntry::make('email')
                    ->label(__('trad.email')),
                TextEntry::make('email_verified_at')
                    ->label(__('trad.email_verified'))
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->label(__('trad.created_at'))
                    ->dateTime('d M y - h:i'),
                TextEntry::make('updated_at')
                    ->label(__('trad.updated_at'))
                    ->dateTime('d M y - h:i'),
                TextEntry::make('total_spent')
                    ->label(__('trad.total_spent'))
                    ->state(function ($record) {
                        // $record es el User
                        return $record->orders
                            ->flatMap(fn($order) => $order->orderItems)
                            ->sum('total_price');
                    })
                    ->money('EUR'),
                // TextEntry::make('default_address_id')
                //     ->numeric(),
                // TextEntry::make('billing_address_id')
                //     ->numeric(),
                IconEntry::make('is_admin')
                    ->boolean(),
            ]);
    }
}

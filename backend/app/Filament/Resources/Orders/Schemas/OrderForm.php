<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use App\Models\User;
use App\Models\Card;
use App\Models\OrderStatus;
use App\Models\Address;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
    return $schema
        ->components([
            Select::make('user_id')
                ->label(__('trad.user'))
                ->relationship('user', 'email') 
                ->required(),
            Select::make('card_id')
                ->label(__('trad.card'))
                ->relationship('card', 'last_4')
                ->nullable(),
            Select::make('status_id')
                ->label(__('trad.status'))
                ->relationship('orderStatus', 'name', function ($query) {
                    $query->orderBy('id'); 
                })
                ->required(),
            Select::make('address_id')
                ->label(__('trad.address'))
                ->relationship('address', 'full_address')
                ->nullable(),
        ]);
    }
}

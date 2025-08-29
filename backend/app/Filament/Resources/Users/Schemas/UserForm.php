<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema , string $mode = 'create'): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('trad.name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('trad.email'))
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                // DateTimePicker::make('email_verified_at')
                //     ->label(__('trad.email_verified')),
                TextInput::make('password')
                    ->label(__('trad.password'))
                    ->placeholder('••••••••')
                    ->password()
                    ->required(fn($record) => ! $record)
                    ->minLength(8)
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state)), // no guardar si está vacío
                // TextInput::make('default_address_id')
                //     ->numeric()
                //     ->default(null),
                // TextInput::make('billing_address_id')
                //     ->numeric()
                //     ->default(null),
                Toggle::make('is_admin')
                    ->label(__('trad.admin'))
                    ->required()
                    ->disabled(fn ($record) => $record && $record->id === auth()->id())
            ]);
    }
}

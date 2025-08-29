<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use App\Filament\Resources\Users\Schemas\UserForm;
class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            // Action::make('changePassword')
            // ->label(__('trad.change_password'))
            // ->button() // o ->icon('heroicon-o-key') para icono
            // ->schema([
            //     TextInput::make('password')
            //         ->label(__('trad.new_password'))
            //         ->password()
            //         ->required()
            //         ->minLength(8),
            //     TextInput::make('password_confirmation')
            //         ->label(__('trad.confirm_password'))
            //         ->password()
            //         ->required()
            //         ->same('password')
            // ])
            // ->action(function (array $data) {
            //     $this->record->update([
            //         'password' => bcrypt($data['password']),
            //     ]);

            //     Notification::make()
            //         ->title(__('trad.password_updated'))
            //         ->success()
            //         ->send();
            // })
        ];
    }
}

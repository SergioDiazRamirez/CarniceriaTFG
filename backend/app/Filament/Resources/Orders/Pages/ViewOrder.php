<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //EditAction::make(),
            Action::make('changeStatus')
                ->label(__('trad.change_status'))
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->schema([
                    Select::make('status_id')
                        ->label(__('trad.status'))
                        ->relationship('orderStatus', 'name', fn ($query) => $query->where('id', '!=', 6)->orderBy('id')) 
                        ->required(),
                ])
                ->action(function ($record, array $data) {
                    //TODO: Lógica de notificaciones y front
                    $record->status_id = $data['status_id'];
                    $record->save();

                    Notification::make()
                        ->title(__('trad.status_changed'))
                        ->success()
                        ->send();
                }),
            Action::make('reject') 
                    ->label(__('trad.reject')) 
                    ->color('danger') 
                    ->visible(fn ($record) => $record->status_id !== 6)
                    ->requiresConfirmation() // pedirá confirmación antes de ejecutar
                    ->action(function ($record, $data) {
                        // TODO: lógica de rechazo
                        $record->status_id = 6;
                        $record->save();
                        Notification::make()
                            ->title('Pedido rechazado')
                            ->success()
                            ->send();
                    }),
        ];
    }
}

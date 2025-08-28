<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('reject') // nombre interno
                    ->label('Rechazar') // texto del botón
                    ->color('danger') // rojo
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

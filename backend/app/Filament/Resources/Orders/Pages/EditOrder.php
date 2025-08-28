<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    //protected function afterSave(): void
    //{   //TODO: Enviar notificación al usuario si se cambia el estado de su pedido. O iniciar devolución
        // $order = $this->record;

        // if ($order->status_id === 3) {

        //     Notification::make()
        //         ->title('El pedido fue aprobado')
        //         ->success()
        //         ->send();
        // }

        // if ($order->status_id === 4) {
        //     // lógica de devolución
        // }
    //}
}

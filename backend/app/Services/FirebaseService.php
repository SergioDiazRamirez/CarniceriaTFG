<?php

namespace App\Services;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Factory;

class FirebaseService
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json')); //config('services.firebase.credentials')
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification($token, $title, $body, $data){
        info('Envía notificacion');
        $message = CloudMessage::new()
                    ->withNotification([
                        'title' => $title,
                        'body'  => $body,
                    ])
                    ->toToken($token)
                    ->withData($data);

        $this->messaging->send($message);
    }

    /**
     * Enviar notificación a un dispositivo concreto
     */
    // public function sendToDevice(string $deviceToken, string $title, string $body): void
    // {
    //     $message = CloudMessage::new()
    //         ->withNotification([
    //             'title' => $title,
    //             'body'  => $body,
    //         ])
    //         ->toToken($deviceToken);

    //     $this->messaging->send($message);
    // }

    // /**
    //  * Enviar notificación a todos los suscritos a un tópico
    //  */
    // public function sendToTopic(string $topic, string $title, string $body): void
    // {
    //     $message = CloudMessage::new()
    //         ->withNotification([
    //             'title' => $title,
    //             'body'  => $body,
    //         ])
    //         ->toTopic($topic);

    //     $this->messaging->send($message);
    // }
}

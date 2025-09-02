<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class NotificationController extends Controller
{
    protected $firebaseService;

    /**
     * Create a new notification instance.
     */
    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function sendPushNotification() { 
        $user = Auth::user();
        $token = $user->fcm_token;
        $title = "Título de la noti";
        $body = "body de la noti";
        $data = ["key1"=>"mifun()asdf", "fcmToken"=>$token];

        $this->firebaseService->sendNotification($token, $title, $body, $data);

        return response()->json(['message' => 'Notificación enviada']);
    }












    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['fcm'];
    // }

    //  public function toFcm($notifiable)
    // {
    //     if (!$notifiable->fcm_token) {
    //         return;
    //     }

    //     $message = CloudMessage::new('token', $notifiable->fcm_token)
    //         ->withNotification([
    //             'title' => 'Estado de tu pedido',
    //             'body'  => "Tu pedido #{$this->order->id} ahora está: {$this->order->status}",
    //         ])
    //         ->withData([
    //             'order_id' => (string) $this->order->id,
    //         ]);

    //     Firebase::messaging()->send($message);
    // }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

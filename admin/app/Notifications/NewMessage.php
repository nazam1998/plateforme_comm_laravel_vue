<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewMessage extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function via($notifiable): array
    {
        // Permet d'envoyer les notifs en temps réel et dans la database
        return ['broadcast', 'database'];
    }
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'data' => $this->data
        ]);
    }
    public function toArray($notifiable)
    {
        return [
            'data' => $this->data
        ];
    }
}

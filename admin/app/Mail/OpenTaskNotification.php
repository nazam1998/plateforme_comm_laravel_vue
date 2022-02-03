<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class OpenTaskNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'nom' => Arr::get($this->data, 'nom'),
            'taches' => Arr::get($this->data, 'taches'),
        ];

        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Your Opened Tasks')
            ->markdown('emails.openTask')
            ->with([
                'nom' => $data['nom'],
                'taches' => $data['taches'],
                'link' => 'http://localhost:8080/messages'
            ]);
    }
}

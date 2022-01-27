<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OpenTaskNotification extends Mailable
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
        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Your Opened Tasks')
            ->markdown('emails.openTask')
            ->with([
                'nom' => $this->data['nom'],
                'taches' => $this->data['taches'],
                'link' => 'http://localhost:8080/messages'
            ]);
    }
}

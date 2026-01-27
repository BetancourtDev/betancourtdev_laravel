<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function build()
    {
        $subject = '🚀 Nuevo lead - ' . ($this->data['name'] ?? 'Contacto');

        return $this->subject($subject)
            ->replyTo($this->data['email'] ?? config('mail.from.address'), $this->data['name'] ?? null)
            ->markdown('emails.contact-lead');
    }
}

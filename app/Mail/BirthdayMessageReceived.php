<?php

namespace App\Mail;

use App\Models\BirthdayMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BirthdayMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BirthdayMessage $birthdayMessage) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Neue Geburtstagsnachricht von '.$this->birthdayMessage->sender_name);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.birthday-message');
    }
}

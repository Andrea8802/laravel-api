<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertMovieMail extends Mailable
{
    use Queueable, SerializesModels;

    public $movie;
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Alert Movie Mail',
            replyTo: ['noreply@bestcinema.com']
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.changeAlert',
        );
    }

}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EditMovie extends Mailable
{
    use Queueable, SerializesModels;

    public $oldMovie;
    public $newMovie;

    public function __construct($oldMovie, $newMovie)
    {
        $this->oldMovie = $oldMovie;
        $this->newMovie = $newMovie;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Movie Edited',
            replyTo: ['noreply@bestcinema.com']
        );
    }


    public function content()
    {
        return new Content(
            view: 'mail.edit-movie',
        );
    }

}
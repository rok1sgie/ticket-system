<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCommentAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Ticket $ticket,
        public TicketComment $comment
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pridėtas komentaras prie bilieto'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ticket_comment_added',
        );
    }
}

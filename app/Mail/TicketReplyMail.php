<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public $messageText;

    /**
     * Create a new message instance.
     */
    public function __construct($ticket, $messageText)
    {
        $this->ticket = $ticket;
        $this->messageText = $messageText;
    }
    public function build()
    {
        return $this->subject('Reply on your Support Ticket: ' . $this->ticket->subject)
                    ->view('emails.ticket_reply')
                    ->with([
                        'ticket' => $this->ticket,
                        'messageText' => $this->messageText,
                    ]);
    }
}

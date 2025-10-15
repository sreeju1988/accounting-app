<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $email;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct($token, $email, $adminName)
    {
        $this->token = $token;
        $this->email = $email;
        $this->adminName = $adminName;
    }

  

   
    /**
     *  Build the message.
     */
    public function build(): static
    {
        return $this->subject('You are invited to join our platform')
                    ->view('emails.agent_invitation');
    }

}

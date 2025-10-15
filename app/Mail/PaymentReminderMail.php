<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ServiceBooking;

class PaymentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $balance;

    public function __construct(ServiceBooking $order, $balance)
    {
        $this->order = $order;
        $this->balance = $balance;
    }

    public function build()
    {
        return $this->subject('Payment Reminder for Service Order #' . $this->order->id)
                    ->view('emails.payment_reminder');
    }
}

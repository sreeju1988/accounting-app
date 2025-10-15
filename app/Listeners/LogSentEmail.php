<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LogSentEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        try {
            $toAddresses = $event->message->getTo();
            $to = '';
            if (is_array($toAddresses)) {
                $to = implode(', ', array_map(function ($address) {
                    return method_exists($address, 'getAddress') ? $address->getAddress() : (string)$address;
                }, $toAddresses));
            }

            $fromAddresses = $event->message->getFrom();
            $from = '';
            if (is_array($fromAddresses)) {
                $from = implode(', ', array_map(function ($address) {
                    return method_exists($address, 'getAddress') ? $address->getAddress() : (string)$address;
                }, $fromAddresses));
            }

            $subject = method_exists($event->message, 'getSubject') ? $event->message->getSubject() : '';
            $body = '';
            if (method_exists($event->message, 'getHtmlBody') && $event->message->getHtmlBody()) {
                $body = $event->message->getHtmlBody();
            } elseif (method_exists($event->message, 'getTextBody')) {
                $body = $event->message->getTextBody();
            }

            // Optional: store logs in DB
            DB::table('email_logs')->insert([
                'to_email' => $to,
                'from_email' => $from,
                'subject' => $subject,
                'body' => $body,
                'created_at' => now(),
            ]);

            // Also log to laravel.log (optional)
            Log::info("Email sent to: {$to}, subject: {$subject}");
        } catch (\Exception $e) {
            Log::error('Email logging failed: ' . $e->getMessage());
        }
    }
}
